<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected function jsonOutputSuccess($data)
    {
      return response()->json([
            'code' => 200, 'status' => 'success','data' => $data
        ], 200);
    }

    protected function jsonOutputError($message)
    {
      return response()->json([
            'error' => ['code' => 400, 'message' => $message]
        ], 400);
    }
}
