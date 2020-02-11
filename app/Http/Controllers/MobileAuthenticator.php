<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationEmailer;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MobileAuthenticator extends Controller
{
    //

    public function getRoles(){
        $roles = Role::where('name','!=','login')->get();
        return response()->json(['roles'=>$roles]);
    }

    public function login(){
        $credentials = request(['email', 'password']);

        if (! $token = auth()->guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Login failed, user unauthorized'], 401);
        }
        $user = User::where('email',request(['email']))->first();
        $message = 'Login successful';
        return $this->respondWithToken($token,$user,$message);
    }

    public function register(Request $request){

        DB::beginTransaction();
        try{
            $user = User::create($request->all());
            $token = auth()->guard('api')->login($user);
            $message = 'Registration successful, an email has been sent for verification purposes';
            $role = Role::where('name',strtolower($request->input('role')))->first();

            $user->roles()->attach($role->id);
            $url = env('APP_URL').'/account-verification/'.$user->id;
            Mail::to($user->email)->send(new RegistrationEmailer($user,$url));
            DB::commit();
            return $this->respondWithToken($token,$user,$message);
        }catch (\Exception $e){
            return response()->json(['message'=>'An error occurred during registration, please try again. '.$e->getMessage()],500);
        }

    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token,$user,$message)
    {
        return response()->json([
            'user'=>$user,
            'messsage'=>$message,
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in' => 'never'
        ],200);
//        'expires_in' => auth('api')->factory()->getTTL() * 60
    }
}
