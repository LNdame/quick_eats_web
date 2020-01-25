<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $super_admin = [
            'super-delete' => true,
            'super-add' => true,
            'super-update' => true,
            'super-view' => true,
        ];

        $vendor_permissions = [
            'vendor-delete' => true,
            'vendor-add' => true,
            'vendor-update' => true,
            'vendor-view' => true,
        ];

        $student_permissions = [
            'student-delete' => true,
            'student-add' => true,
            'student-update' => true,
            'student-view' => true,
        ];

        $super_user = Role::create([
            'name' => 'admin',
            'display_name'=>'Admin',
            'permissions' =>$super_admin,
            'guard_name'=>'web'
        ]);

        $student = Role::create([
            'name' => 'student',
            'display_name'=>'Student',
            'permissions' =>$student_permissions,
            'guard_name'=>'web'
        ]);

        $vendor = Role::create([
            'name' => 'vendor',
            'display_name'=>'Vendor',
            'permissions' =>$vendor_permissions,
            'guard_name'=>'web'
        ]);

    }
}
