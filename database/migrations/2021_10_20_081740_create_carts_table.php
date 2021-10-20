<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('sku');
            $table->integer('item_id');
            $table->float('price', 8, 2);
            $table->float('special_price', 8, 2);
            $table->bigInteger('quantity');
            $table->float('total_amount', 8,2);
            $table->boolean('is_checkout');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
