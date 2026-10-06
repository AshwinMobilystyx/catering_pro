<?php
namespace App\Http\Controllers;
use App\Models\Enquiry; use Illuminate\Http\Request;
class EnquiryController extends Controller {
 public function store(Request $r){$d=$r->validate(['name'=>'required','email'=>'nullable|email','phone'=>'nullable','subject'=>'nullable','message'=>'required']);Enquiry::create($d);return back()->with('success','Thanks! Your enquiry has been received.');}
}