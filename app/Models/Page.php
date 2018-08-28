<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public $timestamps = false;
    protected $table = 'static_pages';
    protected $fillable = [
         'template_name', 'page_title', 'page_slug', 'page_description', 'page_keywords'
     ];
}