<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DepositRequestAccountId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deposit_requests', function (Blueprint $table) {
            $table->bigInteger('account_id')->nullable();
        });
        Schema::table('accounts', function (Blueprint $table) {
            $table->string('cookie')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deposit_requests', function (Blueprint $table) {
            $table->dropColumn('account_id');
        });
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn('cookie');
        });
    }
}
