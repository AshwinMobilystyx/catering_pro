<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Food extends Model {
 protected $table='foods';
 protected $fillable=['category_id','name','slug','description','image','diet_type','price','is_jain','status','sort_order'];
 protected $casts=['price'=>'decimal:2','is_jain'=>'boolean'];
 public function category(){return $this->belongsTo(FoodCategory::class,'category_id');}
}