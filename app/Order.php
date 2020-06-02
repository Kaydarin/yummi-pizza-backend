<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['status', 'deliverycharge', 'currency', 'deleted'];

    public function customer()
    {
    	return $this->belongsTo('App\Customer');
    }

    public function pizzas()
    {
        return $this->belongsToMany('App\Pizza', 'order_pizza', 'order_id', 'pizza_id')
            ->withTimestamps()
            ->withPivot('pizzacount');
    }
}
