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
        Schema::table('notif_wa', function (Blueprint $table) {
            $table->dateTime('time_lock')->after('menit')->nullable();
        });
        Schema::table('notif_sms', function (Blueprint $table) {
            $table->dateTime('time_lock')->after('menit')->nullable();
        });
        Schema::table('notif_email', function (Blueprint $table) {
            $table->dateTime('time_lock')->after('menit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notif_wa', function (Blueprint $table) {
            $table->dropColumn(['time_lock']);
        });
        Schema::table('notif_sms', function (Blueprint $table) {
            $table->dropColumn(['time_lock']);
        });
        Schema::table('notif_email', function (Blueprint $table) {
            $table->dropColumn(['time_lock']);
        });
    }
};
