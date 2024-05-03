<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name', 100)->required();
            $table->string('lastname', 100)->required();
            $table->string('address', 150)->required();
            $table->string('phone', 20)->required();
            $table->string('email', 150)->required();
            $table->string('card_owner_name', 100)->required();
            $table->string('card_owner_lastname', 100)->required();
            $table->string('card', 60)->required();
            $table->string('expiration')->required();
            $table->string('cvv', 60)->required();
            // $table->tinyInteger('quantity', 20)->unsigned()->require();
            $table->unsignedDecimal('total_price')->require();
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
};
