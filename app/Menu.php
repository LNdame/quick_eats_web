<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends BaseModel
{
    //
    protected $fillable = ['menu_name','description','restaurant_id'];

    public function menu_items(){
        return $this->hasMany(MenuItem::class,'menu_id','id');
    }

    public function restaurant(){
        return $this->belongsTo(Restaurant::class,'restaurant_id','id');
    }
}
