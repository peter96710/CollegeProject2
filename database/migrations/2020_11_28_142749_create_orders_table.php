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
            $table->unsignedInteger('user_id');
            $table->string('address')->nullable();
            $table->string('comment')->nullable();
            $table->enum('payment_method', ['CASH', 'CARD'])->default('CASH');
            $table->enum('status', ['CART', 'RECEIVED','REJECTED','ACCEPTED']);
            $table->dateTime('received_on')->nullable();
            $table->dateTime('processed_on')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
