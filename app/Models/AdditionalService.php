<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class AdditionalService extends Model {
 protected $fillable=['name','description','price','status'];
 protected $casts=['price'=>'decimal:2'];
 public function bookings(){return $this->belongsToMany(Booking::class,'booking_additional_services');}
}