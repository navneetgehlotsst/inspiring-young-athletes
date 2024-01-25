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
        Schema::create('question', function (Blueprint $table) {
            $table->id('question_id');
            $table->enum('question_type', ['for_athletes', 'for_parents', 'for_athletes_coaches','for_friday_frenzy','for_coaches'])->default('for_athletes');
            $table->string('question', 255);
            $table->enum('question_status', ['0', '1'])->default(0)->comment('1 => Active', '0=>InActive');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question');
    }
};
