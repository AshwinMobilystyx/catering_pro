<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class BookingItem extends Model {
 protected $fillable=['booking_id','food_id','quantity','notes'];
 public function food(){return $this->belongsTo(Food::class);}
}