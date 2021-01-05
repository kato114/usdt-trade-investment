<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('id_type');
            $table->string('id_number');
            $table->string('residential_address');
            $table->string('referee');
            $table->bigInteger('id_number_upload')->nullable();
            $table->bigInteger('residential_upload')->nullable();
            $table->bigInteger('selfie_upload')->nullable();
            $table->string('status')->default('pending');
            $table->string('password');
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
        Schema::dropIfExists('registrations');
    }
}
