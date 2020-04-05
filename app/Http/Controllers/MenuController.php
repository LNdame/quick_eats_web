<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('menus.index');
    }

    public function getRestaurantMenus(){
        $vendor = Auth::user();
        $menus = Menu::with('restaurant')->get();
        return DataTables::of($menus)

            ->addColumn('action',function($menu){
                $add_menu_items_url = '/menus-add-remove-menu-items';
                $edit_url = "/menus/".$menu->id.'/edit';
                $delete_url = "/menu-delete/".$menu->id."#menus-table";
                $view_url = "/menus/".$menu->id;
                return '<a class="" href=' . $view_url . '  title="View Menu" style="color:darkblue"><i class="material-icons">remove_red_eye</i></a><a class="" href=' . $add_menu_items_url . '  title="Add or Remove Menu Items" style="color:green;margin-left:1em;"><i class="material-icons">assignment</i></a><a class="" href=' . $edit_url . '  title="Edit Menu" style="margin-left:1em;color:blue"><i class="material-icons">create</i></a><a class="" title="Delete Menu" style="color:red" href="#" id="' . $delete_url . '" onclick="confirm_delete(this)" style="margin-left:1em;"> <i class="material-icons">delete_forever</i> </a>';
            })->make(true);
    }

    public function getMenuItems(Menu $menu){
        return response()->json(['menu_with_items'=>$menu->load('menu_items')],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('menus.create');
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
            $menu = Menu::create($request->all());
            DB::commit();
            return redirect('menus')->withStatus('Menu saved successfully, you can proceed to add menu items');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->withStatus('An Error occurred while saving the menu. '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
        return view('menus.edit',compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
        DB::beginTransaction();
        try{
            $menu->update($request->all());
            DB::commit();
            return redirect('menus')->withStatus('Menu updated successfully, you can proceed to update menu items');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->withStatus('An Error occurred while updating the menu. '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
        DB::beginTransaction();
        try{
            $menu->delete();
            DB::commit();
            return response()->json(['message'=>'Menu deleted successfully'],200);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>'An error occurred while deleting the menu. '.$e->getMessage()],500);
        }
    }
}
