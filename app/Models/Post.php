<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false;
    protected $fillable = [
                          'site',
                          'views',
                          'slider',
                          'post_title',
                          'is_scheduled',
                          'author',
                          'page_title',
                          'page_content',
                          'post_excerpt',
                          'aproved',
                          'post_name',
                          'post_category',
                          'post_keywords',
                          'comment_id',
                          'post_thumbnail',
                          'homepage_color',
                          'scheduled_at',
                          'created_at',
                          'updated_at',
                          'homepage'
                          ];
}