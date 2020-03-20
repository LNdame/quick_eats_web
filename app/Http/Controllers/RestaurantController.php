<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;

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
        return view('restraurants.view');
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
