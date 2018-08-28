<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteMaterial extends Model
{   

    protected $table = 'favorites';
    public $timestamps = false;
    protected $fillable = [
         'user_id', 'material_id'
     ];
}