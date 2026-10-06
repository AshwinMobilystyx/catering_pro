<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Package extends Model {
 protected $fillable=['name','slug','description','price_per_person','min_guests','max_guests','image','features','terms','status'];
 protected $casts=['price_per_person'=>'decimal:2','features'=>'array'];
 public function foods(){return $this->belongsToMany(Food::class,'package_food');}
}