<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('seller_id');
            $table->foreignId('orderstatus_id')->constrained()->onDelete('cascade');
            $table->integer('orderno');
            $table->integer('quantity');
            $table->integer('subtotal');
            $table->integer('total');
            $table->string('address');
            $table->string('city');
            $table->string('postal_code');
            $table->string('province');
            $table->string('country');
            $table->integer('phone');
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
        Schema::dropIfExists('orders');
    }
}
