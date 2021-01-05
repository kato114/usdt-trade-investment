<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('account');
            $table->timestamps();
        });

        Schema::table('investor_transactions', function (Blueprint $table) {
            $table->bigInteger('account_id')->nullable();
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->bigInteger('account_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
        Schema::table('acrued_amounts', function (Blueprint $table) {
            $table->dropColumn('account_id');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('account_id');
        });
    }
}
