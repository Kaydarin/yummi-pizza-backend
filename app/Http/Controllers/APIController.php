<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pizza;
use App\Customer;
use App\Order;

class APIController extends Controller
{
    public function getTest(Request $request) {
        error_log('passed here get');
        return response()->json([
            "message" => "get test passed"
        ], 200);
    }

    public function postTest(Request $request) {
        error_log('passed here post');
        return response()->json([
            "message" => "post test passed"
        ], 200);
    }

    public function getPizza(Request $request) {

        $pizzas = Pizza::select('id', 'name', 'description', 'price', 'currency', 'img')
                        // ->where('deleted', false)
                        ->get();
        
        return response()->json($pizzas, 200);
    }

    public function orderPizza(Request $request) {

        $newcustomer = Customer::create([
            'firstname'=> $request->user['firstName'],
            'lastname' => $request->user['lastName'],
            'addressline1' => $request->user['addressLine1'],
            'addressline2' => $request->user['addressLine2'],
            'country' => $request->user['country'],
            'city' => $request->user['city'],
            'poscode' => $request->user['poscode'],
            'phoneno1' => $request->user['phoneNo1'],
            'phoneno2' => $request->user['phoneNo2']
        ]);
       
        $order = $newcustomer->orders()->create([
           'status' => 'placed',  // placed, baking , delivering, completed
           'deliverycharge' => 15.00,
           'currency' => $request->currency
        ]);

        $pizzarequest = $request->pizza;

        foreach ($pizzarequest as $pr) {

            $pizza = Pizza::find($pr['id']);

            if ($pizza !== null) {
                $order->pizzas()->attach($pr['id'], ['pizzacount' => $pr['count']]);
            }
        }

        return response()->json([
            "orderNumber" => $order->id
        ], 201);
    }

    public function getOrder(Request $request) {

        if ($request->input('by') === 'order') {

            $id = $request->input('query');

            $order = Order::select(['*', 'orders.id AS id'])
                            ->join('customers', 'customer_id', '=', 'customers.id')
                            ->where('orders.id', $id)
                            ->first();

            if ($order === null) {
                return response()->json([], 200);
            }

            $pizzaorders = $order->pizzas()
                                    ->select([
                                        'pizzas.id',
                                        "pizzas.name",
                                        "pizzas.description",
                                        "pizzas.price",
                                        "pizzas.currency",
                                        "order_pizza.pizzacount"
                                    ])
                                    ->get();

            $neworder = collect($order);
            $neworder->put("pizza", $pizzaorders);

            $allorder = [$neworder];

            return response()->json( $allorder, 200);
        }

        if ($request->input('by') === 'phone') {

            $phone = $request->input('query');

            $orders = Order::whereHas('customer', function($query) use ($phone) {
                $query->where('phoneno1', $phone);
            })->with('customer')->get();

            $allorder = [];
            
            foreach($orders as $o) {
                $ordermodeltoarray = collect($o->toArray());
                collect($ordermodeltoarray)->map(function ($item, $key) use ($ordermodeltoarray) {
                    
                    if ($key == 'customer') {
                        $ordermodeltoarray->put("firstname", $item{'firstname'});
                        $ordermodeltoarray->put("lastname", $item{'lastname'});
                        $ordermodeltoarray->put("addressline1", $item{'addressline1'});
                        $ordermodeltoarray->put("addressline2", $item{'addressline2'});
                        $ordermodeltoarray->put("country", $item{'country'});
                        $ordermodeltoarray->put("city", $item{'city'});
                        $ordermodeltoarray->put("poscode", $item{'poscode'});
                        $ordermodeltoarray->put("phoneno1", $item{'phoneno1'});
                        $ordermodeltoarray->put("phoneno2", $item{'phoneno2'});
                        $ordermodeltoarray->put("country", $item{'country'});
                    }
                });

                $ordermodeltoarray->forget('customer');

                $pizzaorders = $o->pizzas()
                                    ->select([
                                        'pizzas.id',
                                        "pizzas.name",
                                        "pizzas.description",
                                        "pizzas.price",
                                        "pizzas.currency",
                                        "order_pizza.pizzacount"
                                    ])
                                    ->get();

                $adjustedorder = $ordermodeltoarray->put("pizza", $pizzaorders);

                array_push($allorder, $adjustedorder);
            }

            return response()->json($allorder, 200);
        }
    }
}
