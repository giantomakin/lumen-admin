<?php

namespace App\Http\Controllers;

use App\Factories\FavoriteFactory as FavoriteFactory;
use Illuminate\Http\Request ;

class Favorite extends Controller
{
    protected $favoriteFactory;

    public function __construct(Request $request)
    {   
      $type = $request->route()[2]['type'];
      $this->favoriteFactory = FavoriteFactory::create($type);

    }

    public function addFavorite(Request $request)
    {
      $data = $request->all();
      try {
        $this->favoriteFactory->create($data);
        return response()->json([
          'status' => 'success',
          'message' => 'added'
        ], 200);
      }
      catch (\Exception $e) {
        return response()->json([
          'error' => ['code' => 400, 'message' => $e->getMessage()]
        ], 400);
      }
    }

    public function removeFavorite($id)
    {
      try {
        $this->favoriteFactory->destroy($id);
        return response()->json([
          'status' => 'success',
          'message' => "deleted"
        ], 200);
      }
      catch (\Exception $e) {
        return response()->json([
          'error' => ['code' => 400, 'message' => $e->getMessage()]
        ], 400);
      }
    }

    public function getAllFavorites()
    {
      try {
        $result = $this->favoriteFactory->all();
        return response()->json(['status' => 'success','data' => $result], 200);
      }
      catch (\Exception $e) {
        return response()->json([
          'error' => ['code' => 400, 'message' => $e->getMessage()]
        ], 400);
      }
    }
}
