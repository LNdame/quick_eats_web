<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;
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

        $restaurants = Restaurant::all();
        return DataTables::of($restaurants)
            ->addColumn('action',function($restaurant){
                $edit_url = "restaurants/".$restaurant->id.'/edit';
                $view_url = "restaurants-view/".$restaurant->id;
                $delete_url = "restaurants-delete/".$restaurant->id."#restaurants-table";
                return '<a class="" href=' . $view_url . ' style="color:green!important;"><i class="material-icons">remove_red_eye</i></a><a class="" href=' . $edit_url . '  style="margin-left:1em;" style="color:blue!important;"><i class="material-icons">create</i></a><a class="" style="color:red" href="#" id="' . $delete_url . '" onclick="confirm_delete(this)" style="margin-left:1em;"> <i class="material-icons">delete_forever</i> </a>';
            })->rawColumns(['contact_person','action'])
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
        return view('restaurants.create');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Restaurant  $restraurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restraurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Restaurant  $restraurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restraurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Restaurant  $restraurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restraurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restaurant  $restraurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restraurant)
    {
        //
    }
}
