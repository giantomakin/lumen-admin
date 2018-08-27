<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    public $timestamps = false;
    protected $table = 'post_categories';
    protected $fillable = [
                            'category_name',
                            'category_slug'
                          ];
}