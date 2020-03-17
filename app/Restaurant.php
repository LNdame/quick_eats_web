<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    //
    protected $fillable = ['restaurant_name','description','address','business_hours'];

    public function menus(){
        return $this->hasMany(Menu::class,'restaurant_id','id');
    }
}
