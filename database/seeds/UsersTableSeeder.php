<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = \Illuminate\Support\Facades\Hash::make('secret');
        $verification_time = \Carbon\Carbon::now();

        $super = User::create(['name'=>'Super','surname'=>'Admin','email'=>'admin@quickeats.co.za'
            ,'contact_number'=>'076677777','email_verified_at'=>$verification_time,'password'=>$password]);

        $student = User::create(['name'=>'Student','surname'=>'Customer','email'=>'customer@quickeats.co.za'
            ,'contact_number'=>'076677777','email_verified_at'=>$verification_time,'password'=>$password]);

        $vendor = User::create(['name'=>'Vendor','surname'=>'Vendor','email'=>'vendor@quickeats.co.za'
            ,'contact_number'=>'076677777','email_verified_at'=>$verification_time,'password'=>$password]);


        $role_admin = \App\Role::where('name','admin')->first();
        $super->roles()->attach($role_admin->id);

        $role_student = \App\Role::where('name','customer')->first();
        $student->roles()->attach($role_student->id);

        $role_vendor = \App\Role::where('name','vendor')->first();
        $vendor->roles()->attach($role_vendor->id);
    }
}
