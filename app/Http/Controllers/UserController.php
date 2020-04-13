<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Carbon\Carbon;
use http\Client\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }

    public function getSystemUsers(){
        $users = User::all();
        return DataTables::of($users)
            ->addColumn('action',function($user){
                $edit_url = "user/".$user->id.'/edit';
                $delete_url = "user-delete/".$user->id."#users-table";
                return '<a class="" href=' . $edit_url . '  style="margin-left:1em;" style="color:green"><i class="material-icons">create</i></a><a class="" style="color:red" href="#" id="' . $delete_url . '" onclick="confirm_delete(this)" style="margin-left:1em;"> <i class="material-icons">delete_forever</i> </a>';
            })->addColumn('account_status',function($user){
                if($user->account_status=='in-active'){
                    return '<span class="badge badge-danger">In Active</span>';
                }else{
                    return '<span class="badge badge-success">Active</span>';
                }
            })
            ->addColumn('role',function($user){
                if(count($user->roles)>0){
                    $role = $user->roles[0]->name;
                    if($role == 'admin'){
                        return '<span class="badge badge-primary">Admin</span>';
                    }else if($role =='vendor'){
                        return '<span class="badge badge-success">Vendor</span>';
                    }
                    else if($role =='customer'){
                        return '<span class="badge badge-info">Customer</span>';
                    }
                    else{
                        return '<span class="badge badge-warning">'.$role.'</span>';
                    }
                }else{
                    return '';
                }

            })->rawColumns(['action','role','account_status'])
            ->make(true);
    }
    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $model)
    {
        $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());

        return redirect()->route('user.index')->withStatus(__('User successfully created.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User  $user)
    {
        $hasPassword = $request->get('password');
        $user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$hasPassword ? '' : 'password']
        ));

        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }

    public function updatePassword(Request $request){
        DB::beginTransaction();
        try{
            $user = User::where('email',$request->input('email'))->get();
            $user->password = Hash::make($request->input(['password']));
            $user->save();
            DB::commit();
            return response()->json(['message'=>'Password changed successfully', 'user'=>$user->fresh()],200);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>'An error occurred while updating password. '.$e->getMessage()],500);

        }
    }

    public function updateProfile(Request $request, User  $user)
    {
        DB::beginTransaction();
        try{
            $user->update($request->all());
            DB::commit();
            $user= $user->fresh();
            return response()->json(['message'=>'Profile updated successfully','user'=>$user],200);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>'An error occurred while updating user profile. '.$e->getMessage()],500);
        }

        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User  $user)
    {
        DB::beginTransaction();
        try{
            $user->delete();
            DB::commit();
            return response()->json(['message'=>'User deleted successfully'],200);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>'An error occurred while deleting the user. '.$e->getMessage()],500);
        }
    }

    public function userVerify(User $user){
        $user->email_verified_at = Carbon::now();
        $user->save();
        return redirect('login')->withStatus('Account verified successfully. Proceed to login');
    }
}
