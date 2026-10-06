<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Booking extends Model {
 protected $fillable=['booking_no','user_id','event_type','event_date','start_time','end_time','venue','guest_count','package_id','budget','special_requirements','status','admin_notes'];
 protected $casts=['event_date'=>'date','budget'=>'decimal:2'];
 public function user(){return $this->belongsTo(User::class);}
 public function package(){return $this->belongsTo(Package::class);}
 public function items(){return $this->hasMany(BookingItem::class);}
 public function additionalServices(){return $this->belongsToMany(AdditionalService::class,'booking_additional_services');}
 public function statusHistory(){return $this->hasMany(BookingStatusHistory::class);}
}