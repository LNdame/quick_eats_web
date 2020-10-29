<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourite extends BaseModel
{
    //
    protected $fillable = ['user_id','menu_item_id'];

    public function menu_item(){
        return $this->belongsTo(MenuItem::class,'menu_item_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
