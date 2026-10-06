<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class FoodTastingRequest extends Model {
 protected $fillable=['user_id','name','email','phone','event_type','event_date','guest_count','preferred_date','preferred_time','location','food_preference','message','status','admin_notes'];
 protected $casts=['event_date'=>'date','preferred_date'=>'date'];
 public function user(){return $this->belongsTo(User::class);}
}