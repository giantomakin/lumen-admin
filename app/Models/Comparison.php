<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comparison extends Model
{
    public $timestamps = false;
    protected $fillable = [
         'category1', 'category2', 'video_link', 'article'
     ];
}