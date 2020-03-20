<?php

namespace App\Http\Controllers;

use App\Category;
use App\Mail\RegistrationInvitationMailable;
use App\User;
use App\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('vendors.index');
    }

    public function getVendorsWeb(){
        $vendors = Vendor::with('category')->get();

        return DataTables::of($vendors)
            ->addColumn('contact_person',function($vendor){
                return $vendor->contact_person_name.' '.$vendor->contact_person_surname;
            })
            ->addColumn('category',function($vendor){
                return isset($vendor->category)? $vendor->category->category_name:'';
            })
            ->addColumn('action',function($vendor){
                $edit_url = "vendor/".$vendor->id.'/edit';
                $view_url = "vendor-view/".$vendor->id;
                $delete_url = "vendor-delete/".$vendor->id."#vendors-table";
                return '<a class="" href=' . $view_url . '  style="margin-left:1em;" style="color:green!important;"><i class="material-icons">remove_red_eye</i></a><a class="" href=' . $edit_url . '  style="margin-left:1em;" style="color:blue!important;"><i class="material-icons">create</i></a><a class="" style="color:red" href="#" id="' . $delete_url . '" onclick="confirm_delete(this)" style="margin-left:1em;"> <i class="material-icons">delete_forever</i> </a>';
            })->rawColumns(['contact_person','action'])
            ->make(true);
    }

    public function getVendors(){
        $vendors = Vendor::all();
        return response()->json(['vendors'=>$vendors],200);
    }

    public function getVendorsWithRestaurants(){
        $vendors = Vendor::with('restaurants')->get();
        return response()->json(['vendors'=>$vendors],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('vendors.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
//        dd($request->all());
        DB::beginTransaction();
        try{
            $password = $request->input('contact_person_name').'@'.Carbon::now()->year;
            $request->merge(['password'=>bcrypt($password)]);
            $vendor = Vendor::create($request->all());
            $input = $request->all();
            $user = User::create(['vendor_id'=>$vendor->id,'password'=>$input['password'],'email'=>$input['email'],'name'=>$input['contact_person_name'],'surname'=>$input['contact_person_surname'],'contact_number'=>$input['contact_number']]);

            $url = env('APP_URL').'/account-verification/'.$user->id;

            Mail::to($vendor->email)->send(new RegistrationInvitationMailable($user,$password,$url,$vendor));
            DB::commit();
            return redirect('vendors')->withStatus('Vendor created successfully');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withStatus('An error occurred while saving the vendor. '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //
        DB::beginTransaction();
        try{
            $vendor->delete();
            DB::commit();
            return response()->json(['message'=>'Vendor deleted successfully'],200);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>'An error occurred while deleting the vendor. '.$e->getMessage()],500);
        }
    }
}
