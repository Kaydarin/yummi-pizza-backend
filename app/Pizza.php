<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    public function orders()
    {
        return $this->belongsToMany('App\Order', 'order_pizza', 'pizza_id', 'order_id');
    }
}
