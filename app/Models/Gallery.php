<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Gallery extends Model {
 protected $fillable=['title','description','type','file_path','thumbnail','category','status','sort_order'];
}