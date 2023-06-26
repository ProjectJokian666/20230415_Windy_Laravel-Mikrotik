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
        Schema::create('notif_email', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_adm');
            $table->string('akun_email');
            $table->integer('jam')->default('0');
            $table->integer('menit')->default('0');
            $table->timestamps();

            $table->foreign('id_adm')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notif_email');
    }
};
