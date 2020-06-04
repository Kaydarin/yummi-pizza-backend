<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['status', 'deliverycharge', 'currency', 'deleted'];
    protected $hidden = ['pivot'];
    protected $casts = [
        'deliverycharge' => 'decimal:2',
    ];

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
