<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['firstname', 'lastname', 'addressline1', 'addressline2', 'country', 'city', 'poscode', 'phoneno1', 'phoneno2', 'deleted'];

    public function order()
    {
        return $this->hasOne('App\Order', 'customer_id');
    }
}
