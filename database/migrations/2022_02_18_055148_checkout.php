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
        Schema::create('checkout', function (Blueprint $table) {
            $table->increments('checkout_id');
            $table->integer('customer_id');
            $table->string('kurir');
            $table->string('no_resi')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->string('status');
            $table->string('ongkir');
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
        Schema::drop('checkout');
    }
};
