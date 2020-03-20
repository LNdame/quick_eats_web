<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends BaseModel
{
    //
    protected $fillable = ['restaurant_name','description','address','business_hours','vendor_id'];

    public function menus(){
        return $this->hasMany(Menu::class,'restaurant_id','id');
    }
}