<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request -> validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required | confirmed'
        ]);

        $validatedData['password'] = bcrypt($request->pasword);
       $user = User::create($validatedData);
       
       $accessToken = $user ->createToken('authToken')->access_Token;
       return response(['user'=>$user, 'access_token'=>$accessToken]);

    }

    public function login(Request $request)
    {
        $loginData = $request -> validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if(!auth()->attempt($loginData)){
            return response(['message'=>"Invalid Credentials"]);
        }
        $accessToken = auth()->user ->createToken('authToken')->access_Token;
        return response(['user'=>auth()->user(), 'access_token'=>$accessToken]);

    }
}
