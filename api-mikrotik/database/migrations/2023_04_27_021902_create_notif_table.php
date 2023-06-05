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
        Schema::create('notif_wa', function (Blueprint $table) {
            $table->id();
            $table->integer('id_adm');
            $table->string('no_wa');
            $table->string('no_twilio');
            $table->string('account_sid');
            $table->string('auth_token');
            $table->integer('jam')->default('0');
            $table->integer('menit')->default('0');
            $table->integer('detik')->default('0');
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
        Schema::dropIfExists('notif_wa');
    }
};
