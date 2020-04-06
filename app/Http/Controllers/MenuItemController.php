<?php

namespace App\Http\Controllers;

use App\MenuItem;
use App\Restaurant;
use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('menu-items.index');
    }

    public function getMenuItems(){
        $user = Auth::user();
        $vendor = $user->vendor;
        if(isset($vendor))
            $restaurants = $vendor->restaurants;
        else{
            $restaurants = Restaurant::where('vendor_id',$user->id)->get();
            $restaurants->load('vendor');
        }

        $menus = array();
        foreach ($restaurants as $restaurant){
            foreach ($restaurant->menus as $menu)
                array_push($menus,$menu);
        }
        $menu_items = array();
        foreach ($menus as $menu){
            $menu->load('menu_items');
            if(isset($menu->menu_items))
                foreach ($menu->menu_items as $item)
            array_push($menu_items,$item);
        }

        return DataTables::of($menu_items)

            ->addColumn('action',function($menu_item){
                $edit_url = "/menus-items/".$menu_item->id.'/edit';
                $delete_url = "/menu-delete/".$menu_item->id."#menu-items-table";
                $view_url = "/menu-items/".$menu_item->id;
                return '<a class="" href=' . $edit_url . '  title="Edit Menu" style="color:blue"><i class="material-icons">create</i></a><a class="" title="Delete Menu" style="color:red;margin-left:1em;" href="#" id="' . $delete_url . '" onclick="confirm_delete(this)"> <i class="material-icons">delete_forever</i> </a>';
            })->addColumn('vegan',function($item){
                if($item->is_vegan==0){
                    return '<span class="badge badge-info">No</span>';
                }else{
                    return '<span class="badge badge-success">Yes</span>';
                }
            })->addColumn('halaal',function($item){
                if($item->is_halaal==0){
                    return '<span class="badge badge-info">No</span>';
                }else{
                    return '<span class="badge badge-success">Yes</span>';
                }
            })
            ->rawColumns(['action','vegan','halaal'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = Auth::user();
        $vendor = $user->vendor;
        if(isset($vendor))
            $restaurants = $vendor->restaurants;
        else{
            $restaurants = Restaurant::where('vendor_id',$user->id)->get();
            $restaurants->load('vendor');
        }
        $menus = array();
        foreach ($restaurants as $restaurant){
            foreach ($restaurant->menus as $menu)
             array_push($menus,$menu);
        }
//        dd($menus);
        return view('menu-items.create',compact('menus'));
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
           $menuItem = MenuItem::create($request->all());
           DB::commit();
           return redirect('menu-items')->withStatus('Menu Item Saved Successfully');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withStatus('An error occurred while creating the menu item. '.$e->getMessage());
        }
    }

    public function storeAPI(Request $request)
    {
        //
        DB::beginTransaction();
        try{
            $menuItem = MenuItem::create($request->all());
            DB::commit();
            return response()->json(['message'=>'Menu Item created successfully','menu_item'=>$menuItem],200);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>'An error occurred while saving the menu item'],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MenuItem  $menuItem
     * @return \Illuminate\Http\Response
     */
    public function show(MenuItem $menuItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MenuItem  $menuItem
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuItem $menuItem)
    {
        //

        $user = Auth::user();
        $vendor = $user->vendor;
        if(isset($vendor))
            $restaurants = $vendor->restaurants;
        else{
            $restaurants = Restaurant::where('vendor_id',$user->id)->get();
            $restaurants->load('vendor');
        }
        $menus = array();
        foreach ($restaurants as $restaurant){
            foreach ($restaurant->menus as $menu)
                array_push($menus,$menu);
        }
        return view('menu-items.edit',compact('menuItem','menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MenuItem  $menuItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuItem $menuItem)
    {
        //
        DB::beginTransaction();
        try{
            $menuItem->update($request->all());
            DB::commit();
            return redirect('menu-items')->withStatus('Menu Item updated successfully');
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withStatus('An error occurred while updating the menu item. '.$e->getMessage());
        }
    }

    public function updateAPI(Request $request, MenuItem $menuItem)
    {
        //
        DB::beginTransaction();
        try{
            $menuItem->update($request->all());
            DB::commit();
            return response()->json(['message'=>'Menu Item updated successfully', 'menu_item'=>$menuItem],200);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>'An error occured while updating menu item.'.$e->getMessage()],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MenuItem  $menuItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuItem $menuItem)
    {
        //
        DB::beginTransaction();
        try{
            $menuItem->delete();
            DB::commit();
            return response()->json(['message'=>'Menu Item deleted successfully'],200);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>'An error occurred while deleting menu item'],500);
        }
    }
}
