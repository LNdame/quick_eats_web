<?php

namespace App\Http\Controllers;

use App\Restraurant;
use Illuminate\Http\Request;

class RestraurantController extends Controller
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
     * @param  \App\Restraurant  $restraurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restraurant $restraurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Restraurant  $restraurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restraurant $restraurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Restraurant  $restraurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restraurant $restraurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restraurant  $restraurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restraurant $restraurant)
    {
        //
    }
}
