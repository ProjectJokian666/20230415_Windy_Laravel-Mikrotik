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
        Schema::table('login', function (Blueprint $table) {
            $table->unsignedBigInteger('id_adm')->after('id');
            $table->foreign('id_adm')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('notif_wa', function (Blueprint $table) {
            $table->unsignedBigInteger('id_adm')->after('id');
            $table->foreign('id_adm')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('notif_email', function (Blueprint $table) {
            $table->unsignedBigInteger('id_adm')->after('id');
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
        Schema::table('login', function (Blueprint $table) {
            $table->dropForeign(['id_adm']);
            $table->dropColumn('id_adm');
        });
        Schema::table('notif_wa', function (Blueprint $table) {
            $table->dropForeign(['id_adm']);
            $table->dropColumn('id_adm');
        });
        Schema::table('notif_email', function (Blueprint $table) {
            $table->dropForeign(['id_adm']);
            $table->dropColumn('id_adm');
        });
    }
};
