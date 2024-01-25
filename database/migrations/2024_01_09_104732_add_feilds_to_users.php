<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('user_status', ['0', '1'])->default(1)->comment('1 => Active', '0=>InActive');
            $table->enum('quetion_status', ['0', '1'])->default(0)->comment('1 => Active', '0=>InActive');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_status');
            $table->dropColumn('quetion_status');
        });
    }
};
