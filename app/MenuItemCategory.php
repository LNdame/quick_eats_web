<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItemCategory extends BaseModel
{
    //
    protected $fillable = ['item_category_name','item_category_description','item_category_picture_url'];

    public function menu_items(){
        return $this->hasMany(MenuItem::class,'category_id','id');
    }
}
