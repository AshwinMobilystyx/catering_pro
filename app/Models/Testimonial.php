<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Testimonial extends Model {
 protected $fillable=['customer_name','designation','image','rating','testimonial','status','sort_order'];
}