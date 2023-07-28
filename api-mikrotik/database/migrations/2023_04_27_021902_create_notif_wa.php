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
            $table->string('no_wa');
            $table->string('no_twilio');
            $table->string('account_sid');
            $table->string('auth_token');
            $table->time('mulai')->default('00:01:00');
            $table->time('berakhir')->default('00:01:00');
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
