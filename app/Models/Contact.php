<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $timestamps = false;
    protected $fillable = [
         'city',
         'address',
         'state',
         'phone',
         'fax',
         'email',
         'hours_weekdays',
         'hours_weekend',
         'location_image',
         'contact_meta_description',
         'contact_meta_title',
         'slug'
     ];
}