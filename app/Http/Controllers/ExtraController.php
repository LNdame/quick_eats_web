<?php

namespace App\Http\Controllers;

use App\Extra;
use App\MenuItemCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ExtraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('extras.index');
    }

    public function getExtras(){

        $extras = Extra::where('vendor_id',Auth::user()->vendor->id)->get();

        return DataTables::of($extras)
            ->addColumn('action',function($extra){
                $edit_url = "/extras-edit/".$extra->id.'/edit';
                $delete_url = "/extras-delete/".$extra->id."#extras-table";
                return '<a class="" href=' . $edit_url . '  title="Edit Menu Extra" style="margin-left:1em;color:blue"><i class="material-icons">create</i></a><a class="" title="Delete Extra" style="color:red" href="#" id="' . $delete_url . '" onclick="confirm_delete(this)" style="margin-left:1em;"> <i class="material-icons">delete_forever</i> </a>';
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
        return view('extras.create');
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
            $extra = Extra::create(['name'=>$request->get('name'),'price'=>$request->get('price'),'description'=>$request->get('description'),'vendor_id'=>Auth::user()->vendor->id]);
            DB::commit();
            return redirect('extras')->withStatus('Extra Item Saved Successfully');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect('extras')->withStatus('An error occurred while trying to save the item. '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Extra  $extra
     * @return \Illuminate\Http\Response
     */
    public function show(Extra $extra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Extra  $extra
     * @return \Illuminate\Http\Response
     */
    public function edit(Extra $extra)
    {
        //
        return view('extras.edit',compact('extra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Extra  $extra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Extra $extra)
    {
        //
        DB::beginTransaction();
        try{
           $extra->update($request->all());
            DB::commit();
            return redirect('extras')->withStatus('Extra Item Updated Successfully');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect('extras')->withStatus('An error occurred while trying to update the item. '.$e->getMessage());
        }

    }

    public function storeExtraToMenu(Request $request){
       dd($request->all());
        DB::beginTransaction();
        try{

        }catch(\Exception $e){

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Extra  $extra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Extra $extra)
    {
        //
        DB::beginTransaction();
        try{
            $extra->delete();
            DB::commit();
            return response()->json(['message'=>'Item deleted successfully.'],200);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>'An error occurred while deleting the item. '.$e->getMessage()],500);
        }
    }
}
