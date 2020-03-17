<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends BaseModel
{
    //
    protected $fillable = ['name','category_id','contact_person_name','contact_person_surname','contact_person_contact_number'];
}
