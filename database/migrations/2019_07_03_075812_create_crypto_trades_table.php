<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCryptoTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crypto_trades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('trade_id')->nullable();
            $table->string('price',36,18);
            $table->timestamp('date');
            $table->string('quantity',36,18);
            $table->decimal('total',36,18);
            $table->string('type');
            $table->string('exchange');
            $table->string('currency');
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
        Schema::dropIfExists('crypto_trades');
    }
}
