<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends BaseModel
{
    //
    protected $fillable = ['item_name','item_description','item_picture_url','item_price','notes','is_vegan','is_halal','menu_id'];

    public function menu(){
        return $this->belongsTo(Menu::class,'menu_id','id');
    }
}
