<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Service extends Model {
 protected $fillable=['name','slug','short_description','description','image','price_from','features','status','sort_order'];
 protected $casts=['features'=>'array','price_from'=>'decimal:2'];
}