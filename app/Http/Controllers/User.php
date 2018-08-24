<?php

namespace App\Http\Controllers;

use App\Repositories\BaseRepository as BaseRepository;
use App\User as UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class User extends Controller
{ 
    protected $baseRepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserModel $userModel)
    {   
        $this->baseRepo = new BaseRepository($userModel);
    }
     /**
      * Create a new token.
      * 
      * @param  \App\User   $user
     * @return string
     */
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
        $user = $this->baseRepo->findBy('email', $email)->first();
        if (!$user) {
            return response()->json([
                'error' => 'Email does not exist.'
            ], 400);
        }
        if (Hash::check($password, $user->password)) {
            return response()->json([
                'token' => $this->jwt($user),
                'message' => 'authenticated'
            ], 200);
        }
        return response()->json([
            'error' => 'Email or password is wrong.'
        ], 400);
    }

    public function create(Request $request)
    {
        $data = [
                  'email' => $request->email,
                  'password' => $request->password
                ];
        try {
          $this->baseRepo->create($data);
          return response()->json([
              'message' => 'created'
          ], 200);
        }
        catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function find($id)
    {
      try {
        $user = $this->baseRepo->find($id);
        return response()->json($user, 200);
      }
      catch (\Exception $e) {
          return response()->json([
              'error' => $e->getMessage()
          ], 400);
      }
    }

    public function findBy($att, $column)
    {
      try {
        $user = $this->baseRepo->where($att, $column);
        return response()->json($user, 200);
      }
      catch (\Exception $e) {
          return response()->json([
              'error' => $e->getMessage()
          ], 400);
      }
    }

    public function all()
    {
      try {
        $users = $this->baseRepo->all();
        return response()->json($users, 200);
      }
      catch (\Exception $e) {
          return response()->json([
              'error' => $e->getMessage()
          ], 400);
      }
    }

    public function delete($id)
    {
      try {
        $this->baseRepo->delete($id);
        return response()->json([
            'message' => "deleted user with id: {$id}"
        ], 200);
      }
      catch (\Exception $e) {
          return response()->json([
              'error' => $e->getMessage()
          ], 400);
      }
    }
}
