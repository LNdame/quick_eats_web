<?php

namespace App\Http\Controllers;

use App\MenuItem;
use App\MenuItemCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class MenuItemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('menu-item-categories.index');
    }

    public function getItemCategoriesApi(){
        $categories = MenuItemCategory::with('menu_items')->get();

        return response()->json(['menu_item_categories'=>$categories],200);
    }

    public function getMenuItems(MenuItemCategory $menuItemCategory){
        return response()->json(['menu_items'=>$menuItemCategory->menu_items],200);
    }

    public function getMenuItemCategories(){
        $categories = MenuItemCategory::all();

        return DataTables::of($categories)
            ->addColumn('action',function($category){
                $edit_url = "/category-edit/".$category->id.'/edit';
                $delete_url = "/category-delete/".$category->id."#item-categories-table";
                $view_url = "/menu-items-category-view/".$category->id;
                return '<a class="" href=' . $view_url . '  title="View Menu" style="color:darkblue"><i class="material-icons">remove_red_eye</i></a><a class="" href=' . $edit_url . '  title="Edit Menu" style="margin-left:1em;color:blue"><i class="material-icons">create</i></a><a class="" title="Delete Menu" style="color:red" href="#" id="' . $delete_url . '" onclick="confirm_delete(this)" style="margin-left:1em;"> <i class="material-icons">delete_forever</i> </a>';
            })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('menu-item-categories.create');
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
            $menuItemCategory = MenuItemCategory::create($request->all());
            if($request->hasFile('content_file')){
                $file = $request->file('content_file');
                $ext = $file->getClientOriginalExtension();
                Storage::makeDirectory(date('Y-m'));
                $filename = Carbon::now()->timestamp . '.' . $ext;
                $file_path = Storage::disk('public')->putFileAs('uploads/' . date('Y-m'), $file, $filename);
                if ($file_path) {
                    $menuItemCategory->item_category_picture_url = 'storage/'.$file_path;
                }
            }
            $menuItemCategory->save();

            DB::commit();
            return redirect('menu-items-category')->withStatus('Menu Item Category Saved Successfully');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withStatus('An error occurred while creating the menu item category. '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MenuItemCategory  $menuItemCategory
     * @return \Illuminate\Http\Response
     */
    public function show(MenuItemCategory $menuItemCategory)
    {
        //
        return view('menu-item-categories.view',compact('menuItemCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MenuItemCategory  $menuItemCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuItemCategory $menuItemCategory)
    {
        //
        return view('menu-item-categories.edit',compact('menuItemCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MenuItemCategory  $menuItemCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuItemCategory $menuItemCategory)
    {
        //
        DB::beginTransaction();
        try{
            $menuItemCategory->update($request->all());
            if($request->hasFile('content_file')){
                $file = $request->file('content_file');
                $ext = $file->getClientOriginalExtension();
                Storage::makeDirectory(date('Y-m'));
                $filename = Carbon::now()->timestamp . '.' . $ext;
                $file_path = Storage::disk('public')->putFileAs('uploads/' . date('Y-m'), $file, $filename);
                if ($file_path) {
                    $menuItemCategory->item_category_picture_url = 'storage/'.$file_path;
                }
            }
            $menuItemCategory->save();

            DB::commit();
            return redirect('menu-items-category')->withStatus('Menu Item Category updated Successfully');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withStatus('An error occurred while updating the menu item category. '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MenuItemCategory  $menuItemCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuItemCategory $menuItemCategory)
    {
        //
        DB::beginTransaction();
        try{
            $menuItemCategory->delete();
            DB::commit();
            return response()->json(['message'=>'Category deleted successfully.'],200);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>'An error occurred while deleting the category. '.$e->getMessage()],500);
        }
    }
}
