<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public $timestamps = false;
    protected $fillable = [
         'material_category_id',
         'material_name',
         'material_original_name',
         'material_other_names',
         'material_description',
         'material_online_id',
         'material_country_of_origin',
         'main_color',
         'page_title',
         'material_meta_title',
         'material_meta_description',
         'pattern',
         'last_update'
     ];
}