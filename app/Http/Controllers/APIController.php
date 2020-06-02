<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Pizza;
use App\Customer;
use App\Order;

class APIController extends Controller
{
    public function getTest(Request $request) {
        error_log('passed here get');
        return response()->json([
            "message" => "get test passed"
        ], 201);
    }

    public function getPizza(Request $request) {

        $pizzas = Pizza::select('name', 'description', 'price', 'currency', 'img')->get();
        error_log($pizzas);
        // Log::info('bitch');
        return response()->json($pizzas, 200);
    }

    public function orderPizza(Request $request) {
        error_log('passed here post');


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
       
        $order = $newcustomer->order()->create([
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

        // error_log($order);
        // $user = Order::find($order->id);
        // error_log($user);
        // $pz = [
        //     (object) ['pid' => 1],
        //     (object) ['pid' => 5],
        //     (object) ['pid'=> 7]
        // ];

        // $myObject = new \StdClass();
        // $myObject->pid = 1;
        // $myObject->pid = 2;

        // foreach ($pz as $p) {
        //     // error_log($p->pid);
        // }

        
        
        // $order->pizzas()->attach(1, ['pizzacount' => 10])
        // error_log($request->firstName);

        // $order = new Order;
        // $order->name = $request->name;
        // $order->course = $request->course;
        // $order->save();

        
        // return response()->json([
        //     "message" => "get post pass"
        // ], 201);

        return response()->json([
            "orderNumber" => $order->id
        ], 201);
    }
}
