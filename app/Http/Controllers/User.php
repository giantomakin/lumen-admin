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
            return $this->jsonOutputSuccess('created');
        }
        catch (\Exception $e) {
            return $this->jsonOutputError($e->getMessage());
        }
    }
    
    public function find($id)
    {
      try {
          $result = $this->baseRepo->find($id);
          return $this->jsonOutputSuccess($result);
      }
      catch (\Exception $e) {
          return $this->jsonOutputError($e->getMessage());
      }
    }

    public function findBy($att, $column)
    {
      try {
        $result = $this->baseRepo->findBy($att, $column);
        return $this->jsonOutputSuccess($result);
      }
      catch (\Exception $e) {
          return $this->jsonOutputError($e->getMessage());
      }
    }

    public function all()
    {
      try {
          $result = $this->baseRepo->all();
          return $this->jsonOutputSuccess($result);
      }
      catch (\Exception $e) {
          return $this->jsonOutputError($e->getMessage());
      }
    }

    public function delete($id)
    {
      try {
          $this->baseRepo->destroy($id);
          return $this->jsonOutputSuccess('deleted');
      }
      catch (\Exception $e) {
          return $this->jsonOutputError($e->getMessage());
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
          $this->jsonOutputSuccess('updated');
        }
        catch (\Exception $e) {
            return $this->jsonOutputError($e->getMessage());
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
        $user = $this->baseRepo->findBy('email', $email)->first();
        if (!$user) {
            return $this->jsonOutputError('Email does not exist.');
        }
        if (Hash::check($password, $user->password)) {
            $api_token = $this->jwt($user);
            $this->baseRepo->findBy('email', $email)->update(['api_token' => $api_token]);
            return $this->jsonOutputSuccess( ['api_token' => $this->jwt($user)]);
        }
        return $this->jsonOutputError('Email or password is wrong');
    }

    public function checkAuthUser()
    {
      try {
          $user = Auth::user();
          return $this->jsonOutputSuccess($user);

      }
      catch (\Exception $e) {
          return $this->jsonOutputError($e->getMessage());
      }
    }
}
