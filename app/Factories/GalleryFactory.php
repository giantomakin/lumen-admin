<?php
namespace App\Factories;

class GalleryFactory 
{ 
  const NS = "App\\Models\\";

  public static function create ($type = '') {  
    if($type == '') {
      throw new \Exception('Invalid Gallery Type.');
    } else {
      $className = self::NS.'Gallery'.ucfirst($type);
      if(class_exists($className)) {
        return new $className();
      } else {
        throw new \Exception('Gallery type not found.');
      }
    }
  }
}
