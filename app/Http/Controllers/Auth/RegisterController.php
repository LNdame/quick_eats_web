<?php

namespace App\Http\Controllers\Auth;

use App\Category;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Role;
use App\User;
use App\Vendor;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    public function showRegistrationForm()
    {
        $roles = Role::where('name','!=','admin')->get();
        $categories = Category::all();
        return view('auth.register',compact('roles','categories'));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    public function register(Request $request)
    {
//        dd($request->all());
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

//        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $token = Str::random(60);
        $user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'contact_number' => $data['contact_number'],
            'gender'=>$data['gender'],
            'password' => Hash::make($data['password']),
//            'api_token' => $token,
        ]);
        $vendor=Role::where('name','vendor')->first();
        if($data['role']==$vendor->id){
            $vendor = Vendor::create(['trading_name'=>$data['trading_name'],'email'=>$data['email'],'category_id'=>$data['category_id'],'contact_person_name'=>$data['name'],'contact_person_surname'=>$data['name'],'contact_number' => $data['contact_number'],'user_id'=>$user->id]);
        }

       $user->roles()->attach($data['role']);
        return $user;
    }
}
