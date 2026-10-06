<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class FoodCategory extends Model {
 protected $fillable=['name','slug','description','status','sort_order'];
 public function foods(){return $this->hasMany(Food::class,'category_id');}
}