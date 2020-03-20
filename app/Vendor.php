<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends BaseModel
{
    //
    protected $fillable = ['trading_name','email','category_id','contact_person_name','contact_person_surname','contact_number'];

    public function restaurants(){
        return $this->hasMany(Restaurant::class,'vendor_id','id');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
