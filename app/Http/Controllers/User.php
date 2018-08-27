<?php

namespace App\Http\Controllers;

use App\Repositories\BaseRepository as BaseRepository;
use App\User as UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class User extends Controller
{ 
    protected $baseRepo;

    public function __construct(UserModel $userModel)
    {   
        $this->baseRepo = new BaseRepository($userModel);
    }

    public function create(Request $request)
    {
        $data = [
                  'email' => $request->input('email'),
                  'password' => $request->input('password')
                ];

        try {
          $this->baseRepo->create($data);
          return response()->json([
              'status' => 'success',
              'message' => 'created'
          ], 200);
        }
        catch (\Exception $e) {
            return response()->json([
                'error' => ['code' => 400, 'message' => $e->getMessage()]
            ], 400);
        }
    }
    
    public function find($id)
    {
      try {
        $result = $this->baseRepo->find($id);
        return response()->json(['status' => 'success','data' => $result], 200);
      }
      catch (\Exception $e) {
          return response()->json([
              'error' => ['code' => 400, 'message' => $e->getMessage()]
          ], 400);
      }
    }

    public function findBy($att, $column)
    {
      try {
        $result = $this->baseRepo->findBy($att, $column);
        return response()->json(['status' => 'success','data' => $result], 200);
      }
      catch (\Exception $e) {
          return response()->json([
              'error' => ['code' => 400, 'message' => $e->getMessage()]
          ], 400);
      }
    }

    public function all()
    {
      try {
        $result = $this->baseRepo->all();
        return response()->json(['status' => 'success','data' => $result], 200);
      }
      catch (\Exception $e) {
          return response()->json([
              'error' => ['code' => 400, 'message' => $e->getMessage()]
          ], 400);
      }
    }

    public function delete($id)
    {
      try {
        $this->baseRepo->destroy($id);
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

    public function update($id, Request $request)
    {  
        $data = [
                  'email' => $request->input('email'),
                  'password' => Hash::make($request->input('password'))
                ];
        try {
          $this->baseRepo->update($id, $data);
          return response()->json([
              'status' => 'success',
              'message' => "updated"
          ], 200);
        }
        catch (\Exception $e) {
            return response()->json([
                'error' => ['code' => 400, 'message' => $e->getMessage()]
            ], 400);
        }
    }

    protected function jwt(UserModel $user) 
    {
       $payload = [
           'iss' => "lumen-jwt",     // Issuer of the token
           'sub' => $user->id,      // Subject of the token
           'iat' => time(),        // Time when JWT was issued. 
           'exp' => time() + env('JWT_TTL')      // Expiration time
       ];
      return JWT::encode($payload, env('JWT_KEY'));
    }

    public function authenticate(Request $request)
    {  
        $email = $request->input('email');
        $password = $request->input('password');
        $user =  UserModel::where('email', $email)->first();
        if (!$user) {
            return response()->json([
                'error' => 'Email does not exist.'
            ], 400);
        }
        if (Hash::check($password, $user->password)) {
            $api_token = $this->jwt($user);
            UserModel::where('email', $email)->update(['api_token' => $api_token]);
            return response()->json([
                'status' => 'success',
                'data' => ['api_token' => $this->jwt($user)],
                'message' => 'authenticated'
            ], 200);
        }
        return response()->json([
            'error' => 'Email or password is wrong.'
        ], 400);
    }

    public function checkAuthUser()
    {
      try {
        $user = Auth::user();
        return response()->json(['status' => 'success','data' => $user], 200);
      }
      catch (\Exception $e) {
          return response()->json([
              'error' => ['code' => 400, 'message' => $e->getMessage()]
          ], 400);
      }
    }
}
