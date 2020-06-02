<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CreatePizzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pizzas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->decimal('price', 15, 2);
            $table->string('currency')->default('USD');
            $table->string('img')->nullable();
            $table->boolean('deleted')->default(false);
            $table->timestamps();
        });

        DB::table('pizzas')->insert(
            array(
                'name' => 'Pepperoni Usuals',
                'description' => 'Some nice toppings included',
                'price' => 9.99,
                'currency' => 'USD',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
        DB::table('pizzas')->insert(
            array(
                'name' => 'Macaroni Loveronii',
                'description' => 'Some nice toppings included',
                'price' => 18.99,
                'currency' => 'USD',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
        DB::table('pizzas')->insert(
            array(
                'name' => 'Hawaiian Stuff',
                'description' => 'Some nice toppings included',
                'price' => 23.99,
                'currency' => 'USD',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
        DB::table('pizzas')->insert(
            array(
                'name' => 'Chika Chick',
                'description' => 'Some nice toppings included',
                'price' => 12.99,
                'currency' => 'USD',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
        DB::table('pizzas')->insert(
            array(
                'name' => 'Beat the Meat',
                'description' => 'Some nice toppings included',
                'price' => 16.99,
                'currency' => 'USD',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
        DB::table('pizzas')->insert(
            array(
                'name' => 'Veggie Diet',
                'description' => 'Some nice toppings included',
                'price' => 8.99,
                'currency' => 'USD',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
        DB::table('pizzas')->insert(
            array(
                'name' => 'Seafood Sensation',
                'description' => 'Some nice toppings included',
                'price' => 27.99,
                'currency' => 'USD',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
        DB::table('pizzas')->insert(
            array(
                'name' => 'PrawnXFish',
                'description' => 'Some nice toppings included',
                'price' => 30.99,
                'currency' => 'USD',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
        DB::table('pizzas')->insert(
            array(
                'name' => 'Tuna Muna',
                'description' => 'Some nice toppings included',
                'price' => 15.99,
                'currency' => 'USD',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pizzas');
    }
}
