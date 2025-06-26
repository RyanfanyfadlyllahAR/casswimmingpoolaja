<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->text('catatan_admin')->nullable()->after('settlement_time');
            $table->unsignedBigInteger('updated_by_admin')->nullable()->after('catatan_admin');
            
            $table->foreign('updated_by_admin')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropForeign(['updated_by_admin']);
            $table->dropColumn(['catatan_admin', 'updated_by_admin']);
        });
    }
};