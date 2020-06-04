<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    protected $hidden = ['pivot'];
    protected $casts = [
        'price' => 'decimal:2',
    ];
    public function orders()
    {
        return $this->belongsToMany('App\Order', 'order_pizza', 'pizza_id', 'order_id');
    }
}
