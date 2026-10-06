<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroBanner extends Model
{
    protected $fillable = [
        'title','subtitle','button_text','button_url','secondary_button_text','secondary_button_url',
        'image','mobile_image','status','sort_order'
    ];

    protected $casts = ['status' => 'boolean'];
}
