<?php
namespace App\Factories;

class FavoriteFactory 
{ 
  const NS = "App\\Models\\";

  public static function create ($type = '') {  
    if($type == '') {
      throw new \Exception('Invalid Favorite Type.');
    } else {
      $className = self::NS.'Favorite'.ucfirst($type);
      if(class_exists($className)) {
        return new $className();
      } else {
        throw new \Exception('Favorite type not found.');
      }
    }
  }
}
