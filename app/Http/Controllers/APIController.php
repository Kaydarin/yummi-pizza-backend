<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Pizza;

class APIController extends Controller
{
    public function getTest(Request $request) {
        return response()->json([
            "message" => "some message"
        ], 201);
    }

    public function getPizza(Request $request) {

        $pizzas = Pizza::select('name', 'description', 'price', 'currency', 'img')->get();
        error_log($pizzas);
        // Log::info('bitch');
        return response()->json($pizzas, 201);
    }
}
