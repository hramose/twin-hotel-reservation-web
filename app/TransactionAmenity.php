<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionAmenity extends Model
{
    public function amenity(){
    	return $this->belongsto('App\Amenity');
    }
}
