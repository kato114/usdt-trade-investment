<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestorTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investor_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('investor_id')->index();
            $table->bigInteger('transaction_id')->index()->nullable();
            $table->string("type");
            $table->string("narration");
            $table->decimal("amount", 14, 2)->default(0);
            $table->timestamp('date');
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
        Schema::dropIfExists('investor_transactions');
    }
}
