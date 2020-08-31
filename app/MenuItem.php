<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends BaseModel
{
    //
    protected $fillable = ['item_name','item_description','item_picture_url','item_price','notes','is_vegan','is_halal','menu_id','category_id'];

    public function menu(){
        return $this->belongsTo(Menu::class,'menu_id','id');
    }

    public function category(){
        return $this->belongsTo(MenuItemCategory::class,'category_id','id');
    }

    public function orders(){
        return $this->belongsToMany(Order::class);
    }
}
