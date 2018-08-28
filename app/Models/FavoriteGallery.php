<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteGallery extends Model
{   
    protected $table = 'favorites_gallery';
    public $timestamps = false;
    protected $fillable = [
         'user_id', 'gallery_id'
     ];
}