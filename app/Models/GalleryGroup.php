<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryGroup extends Model
{
    public $timestamps = false;
    protected $table = 'gallery_groups';
    protected $fillable = [
         'gallery_group_name',
         'gallery_group_summary',
         'gallery_group_url',
         'page_title',
         'gallery_group_meta_description',
         'gallery_group_main_photo_id',
         'added_at',
         'order'
     ];

    public function albums()
    {
        return $this->hasMany('App\Models\GalleryAlbum');
    }
}