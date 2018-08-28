<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryAlbum extends Model
{
    public $timestamps = false;
    protected $table = 'gallery_albums';
    protected $fillable = [
         'subcategory_id',
         'gallery_group_id',
         'album_name',
         'album_description',
         'material_application_ids',
         'material_color_ids',
         'page_title',
         'created_at',
         'last_update',
         'primary_edge',
         'secondary_edge',
         'gallery_tool_id',
         'gallery_tool_id2',
         'gallery_meta_title',
         'gallery_meta_description'
     ];
}