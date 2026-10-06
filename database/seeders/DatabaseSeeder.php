<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
use App\Models\FoodCategory;
use App\Models\Food;
use App\Models\Package;
use App\Models\AdditionalService;
use App\Models\Testimonial;
// use App\Models\WebsiteSetting,HeroBanner;
use App\Models\WebsiteSetting;
use App\Models\HeroBanner;
class DatabaseSeeder extends Seeder {
 public function run(): void {
  User::updateOrCreate(['email'=>'admin@catering.test'],['name'=>'Catering Admin','password'=>'password','role'=>'admin','phone'=>'9999999999']);
  User::updateOrCreate(['email'=>'customer@catering.test'],['name'=>'Demo Customer','password'=>'password','role'=>'customer','phone'=>'8888888888']);
  $services=[['Wedding Catering','Elegant wedding menus and full-service event catering.'],['Corporate Catering','Professional meals for meetings, conferences and office events.'],['Birthday & Party Catering','Flexible menus for private celebrations and parties.'],['Outdoor Catering','On-site catering for outdoor events and special occasions.']];
  foreach($services as $i=>$s) Service::updateOrCreate(['slug'=>str($s[0])->slug()],['name'=>$s[0],'short_description'=>$s[1],'description'=>$s[1],'status'=>true,'sort_order'=>$i]);
  $cats=['Starters','Main Course','Rice & Breads','Desserts','Beverages'];
  foreach($cats as $i=>$c) FoodCategory::updateOrCreate(['slug'=>str($c)->slug()],['name'=>$c,'status'=>true,'sort_order'=>$i]);
  $starter=FoodCategory::where('slug','starters')->first();
  foreach([['Paneer Tikka','veg',true],['Hara Bhara Kebab','veg',true],['Chicken Tikka','non_veg',false]] as $i=>$f) Food::updateOrCreate(['slug'=>str($f[0])->slug()],['category_id'=>$starter->id,'name'=>$f[0],'diet_type'=>$f[1],'is_jain'=>$f[2],'description'=>'Chef-special catering menu item.','status'=>true,'sort_order'=>$i]);
  Package::updateOrCreate(['slug'=>'gold-package'],['name'=>'Gold Package','description'=>'Popular package for weddings and large celebrations.','price_per_person'=>899,'min_guests'=>50,'max_guests'=>1000,'features'=>['Welcome Drinks','Starters','Main Course','Desserts'],'status'=>true]);
  foreach([['Decoration','Basic event decoration'],['Waiters & Staff','Trained serving staff'],['Live Counter','Chef-operated live food counter'],['Crockery','Plates, cutlery and serving equipment']] as $s) AdditionalService::updateOrCreate(['name'=>$s[0]],['description'=>$s[1],'status'=>true]);
  Testimonial::updateOrCreate(['customer_name'=>'Rahul Sharma'],['testimonial'=>'Excellent food and professional service. Our guests loved everything!','rating'=>5,'status'=>true]);
  foreach([
   'business_name'=>'Catering Pro',
   'hero_badge'=>'Premium Catering & Events',
   'instagram'=>'#',
   'facebook'=>'#',
   'youtube'=>'#',
   'tagline'=>'Delicious food. Memorable celebrations.',
   'phone'=>'+91 99999 99999',
   'whatsapp'=>'919999999999',
   'email'=>'hello@catering.test',
   'address'=>'Your business address',
   'opening_hours'=>'Mon - Sun: 9:00 AM - 9:00 PM',
   'hero_title'=>'Exceptional Catering for Every Celebration',
   'hero_subtitle'=>'Fresh food, beautiful presentation and reliable event service.',
   'about'=>'We create memorable events through great food and thoughtful service.',
   'max_events_per_day'=>'3'
  ] as $k=>$v) WebsiteSetting::set($k,$v);

  HeroBanner::firstOrCreate(['title'=>'Exceptional Catering for Every Celebration'],['subtitle'=>'Fresh food, beautiful presentation and reliable event service.','button_text'=>'Plan My Event','button_url'=>'/contact','secondary_button_text'=>'See Our Work','secondary_button_url'=>'/gallery','image'=>'demo/hero-placeholder.svg','status'=>true,'sort_order'=>1]);
 }
}