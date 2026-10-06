<?php
namespace App\Http\Controllers;
use App\Models\{User,Booking,FoodTastingRequest,Package,Food,AdditionalService};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class CustomerController extends Controller {
 private function user(){return User::findOrFail(session('customer_id'));}
 public function dashboard(){ $u=$this->user(); return view('customer.dashboard',['user'=>$u,'bookings'=>$u->bookings()->latest()->take(5)->get(),'tastings'=>$u->foodTastingRequests()->latest()->take(5)->get()]);}
 public function bookings(){return view('customer.bookings',['bookings'=>$this->user()->bookings()->with('package')->latest()->paginate(10)]);}
 public function createBooking(){return view('customer.booking-create',['packages'=>Package::where('status',1)->get(),'foods'=>Food::where('status',1)->get(),'extras'=>AdditionalService::where('status',1)->get()]);}
 public function storeBooking(Request $r){$d=$r->validate(['event_type'=>'required','event_date'=>'required|date|after_or_equal:today','start_time'=>'nullable','end_time'=>'nullable','venue'=>'required','guest_count'=>'required|integer|min:1','package_id'=>'nullable|exists:packages,id','budget'=>'nullable|numeric|min:0','special_requirements'=>'nullable|string']);$count=Booking::whereDate('event_date',$d['event_date'])->whereIn('status',['pending','contacted','quotation_sent','confirmed','in_progress'])->count();$max=(int)\App\Models\WebsiteSetting::get('max_events_per_day',3);if($count >= $max)return back()->withInput()->with('error','This date is currently at capacity. Please choose another date.');$d['user_id']=$this->user()->id;$d['booking_no']='CAT-'.now()->format('Ymd').'-'.strtoupper(Str::random(6));$b=Booking::create($d);$b->statusHistory()->create(['status'=>'pending','note'=>'Booking request submitted by customer.']);$b->items()->createMany(collect($r->input('food_ids',[]))->map(fn($id)=>['food_id'=>$id,'quantity'=>1])->all());$b->additionalServices()->sync($r->input('additional_service_ids',[]));return redirect('/customer/bookings')->with('success','Booking request submitted. Booking ID: '.$b->booking_no);}
 public function showBooking(Booking $booking){abort_unless($booking->user_id==session('customer_id'),403);return view('customer.booking-show',['booking'=>$booking->load(['package','items.food','additionalServices','statusHistory'])]);}
 public function tastingForm(){return view('customer.tasting-create');}
 public function storeTasting(Request $r){$d=$r->validate(['event_type'=>'nullable','event_date'=>'nullable|date','guest_count'=>'nullable|integer|min:1','preferred_date'=>'required|date|after_or_equal:today','preferred_time'=>'nullable','location'=>'nullable','food_preference'=>'nullable','message'=>'nullable']);$u=$this->user();FoodTastingRequest::create($d+['user_id'=>$u->id,'name'=>$u->name,'email'=>$u->email,'phone'=>$u->phone]);return back()->with('success','Food tasting request submitted.');}
 public function tastings(){return view('customer.tastings',['tastings'=>$this->user()->foodTastingRequests()->latest()->paginate(10)]);}
 public function profile(){return view('customer.profile',['user'=>$this->user()]);}
 public function updateProfile(Request $r){$d=$r->validate(['name'=>'required','phone'=>'nullable','address'=>'nullable']);$this->user()->update($d);return back()->with('success','Profile updated.');}
}