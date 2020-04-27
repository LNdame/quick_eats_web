<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends BaseModel
{
    //
    use SoftDeletes;

    protected $fillable = ['user_id','restaurant_id','total_amount','total_items','preparation_time','status','ordered_on_raw','ordered_on'];

    public function order_items(){
        return $this->belongsToMany(MenuItem::class,'menu_item_order','order_id','menu_item_id');
    }
}
