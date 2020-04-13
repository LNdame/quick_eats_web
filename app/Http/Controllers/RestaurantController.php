<?php

namespace App\Http\Controllers;

use App\Category;
use App\Restaurant;
use App\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('restaurants.index');
    }

    public function adminGetRestaurants(){

        $restaurants = Restaurant::with('vendor')->get();
        return DataTables::of($restaurants)
            ->addColumn('action',function($restaurant){
                $edit_url = "restaurants/".$restaurant->id.'/edit';
                $view_url = "restaurants-view/".$restaurant->id;
                $delete_url = "restaurants-delete/".$restaurant->id."#restaurants-table";
                return '<a class="" href=' . $view_url . ' style="color:green!important;"><i class="material-icons">remove_red_eye</i></a><a class="" href=' . $edit_url . '  style="margin-left:1em;color:blue!important;"><i class="material-icons">create</i></a><a class="" style="color:red;margin-left:1em;" href="#" id="' . $delete_url . '" onclick="confirm_delete(this)" > <i class="material-icons">delete_forever</i> </a>';
            })->addColumn('vendor',function($restaurant){
                if(isset($restaurant->vendor))
                    return $restaurant->vendor->trading_name;
                else
                    return '';
            })
            ->rawColumns(['vendor','action'])
            ->make(true);
    }

    public function getRestaurants(){
        $restaurants = Restaurant::with('menus')->get();

        return response()->json(['restaurants'=>$restaurants],200);
    }

    public function getRestaurant(Restaurant $restaurant){

        $restaurant_cur = $restaurant->load('menus');
        return response()->json(['restaurant'=>$restaurant_cur],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $vendors = Vendor::all();
        return view('restaurants.create',compact('vendors'));
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
        DB::beginTransaction();
        try{
            $restaurant = Restaurant::create($request->all());
            DB::commit();
            return redirect('restaurants')->withStatus('Restaurant saved successfully');
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withStatus('An error occurred while saving the restaurant. '.$e->getMessage());
        }
    }

    public function vendorSaveRestaurant(Request $request){
        DB::beginTransaction();
        try{
//            dd($request->all());
            $restaurant = Restaurant::create($request->all());
            if($request->hasFile('content_file')){
                $file = $request->file('content_file');
                $ext = $file->getClientOriginalExtension();
                Storage::makeDirectory(date('Y-m'));
                $filename = Carbon::now()->timestamp . '.' . $ext;
                $file_path = Storage::disk('public')->putFileAs('uploads/' . date('Y-m'), $file, $filename);
                if ($file_path) {
                    $restaurant->picture_url = 'storage/'.$file_path;
                }
            }
            $restaurant->save();
            DB::commit();
            return redirect('vendor-restaurants')->withStatus('Restaurant saved successfully');
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withStatus('An error occurred while saving the restaurant. '.$e->getMessage());
        }
    }

    public function saveVendorRestaurant(Request $request){
        DB::beginTransaction();
        $input = $request->input(['form-data']);
        $data = array();
        parse_str($input,$data);
        try{
            $restaurant = Restaurant::create($data);
            if($request->hasFile('content_file')){
                $file = $request->file('content_file');
                $ext = $file->getClientOriginalExtension();
                Storage::makeDirectory(date('Y-m'));
                $filename = $restaurant->restaurant_name.Carbon::now() . '.' . $ext;
                $file_path = Storage::disk('s3')->putFileAs('uploads/' . date('Y-m'), $file, $filename);
                if ($file_path) {
                    $restaurant->picture_url = $file_path;
                }
            }
            $restaurant->save();

            DB::commit();
            $vendor = $restaurant->vendor;
            $restaurants = $vendor->restaurants;
            return response()->json(['message'=>'Restaurant saved successfully','restaurant'=>$restaurant,'restaurants'=>$restaurants],200);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>'An error occurred while saving the restaurant. '.$e->getMessage()],500);
        }

    }

    public function storeAPI(Request $request)
    {
        //
        DB::beginTransaction();
        try{
            $restaurant = Restaurant::create($request->all());
            DB::commit();
            return response()->json(['message'=>'Restaurant saved successfully','restaurant'=>$restaurant],200);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>'An error occurred while saving the restaurant. '.$e->getMessage()],500);
        }
    }

    public function vendorEditRestaurant(Restaurant $restaurant){
        $categories = Category::all();
        $user = Auth::user();
        if(isset($user->vendor))
            $vendor_id = $user->vendor->id;
        else{
            $vendor_id = $user->id;
        }

        return view('vendor-restaurants.edit',compact('categories','vendor_id','restaurant'));
    }

    public function updateVendorRestaurant(Request $request,Restaurant $restaurant){
        DB::beginTransaction();
        try{
            $restaurant->update($request->all());
            $restaurant = $restaurant->fresh();
            if($request->hasFile('content_file')){
                $file = $request->file('content_file');
                $ext = $file->getClientOriginalExtension();
                Storage::makeDirectory(date('Y-m'));
                $filename = Carbon::now()->timestamp . '.' . $ext;
                $file_path = Storage::disk('public')->putFileAs('uploads/' . date('Y-m'), $file, $filename);
                if ($file_path) {
                    $restaurant->picture_url = 'storage/'.$file_path;
                }
            }

            $restaurant->save();
            DB:commit();
            return redirect('vendor-restaurants')->withStatus('Restaurant updated successfully');
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withStatus('An error occurred while updating the restaurant. '.$e->getMessage());
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Restaurant  $restraurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        //
        $vendors = Vendor::all();
        return view('restaurants.view',compact('restaurant','vendors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Restaurant  $restraurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        //
        $vendors = Vendor::all();
        return view('restaurants.edit',compact('restaurant','vendors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Restaurant  $restraurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //
        DB::beginTransaction();
        try{
            $restaurant->update($request->all());
            DB::commit();
            return redirect('restaurants')->withStatus('Restaurant updated successfully');
        }catch (\Exception $e){
            return redirect()->back()->withStatus('An error occurred while updating the restaurant');
        }
    }

    public function updateApi(Request $request, Restaurant $restaurant)
    {
        //
        DB::beginTransaction();
        try{
            $restaurant->update($request->all());
            DB::commit();
            return response()->json(['message'=>'Restaurant updated successfully','restaurant'=>$restaurant->fresh()],200);
        }catch (\Exception $e){
            return response()->json(['message'=>'An error occurred while updating the restaurant. '.$e->getMessage()],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restaurant  $restraurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        //
        DB::beginTransaction();
        try{

            $restaurant->delete();
            DB::commit();
            return response()->json(['message'=>'Restaurant deleted successfully','status'=>'success'],200);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>'An error occurred while deleting the restaurant the restaurant.'.$e->getMessage(),'status'=>'failure'],500);
        }
    }


}
