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
        Schema::create('user_queston', function (Blueprint $table) {
            $table->id('user_queston_id');
            $table->bigInteger('user_id');
            $table->bigInteger('question_id');
            $table->enum('user_queston_type', ['for_athletes', 'for_parents', 'for_athletes_coaches','for_friday_frenzy','for_coaches'])->default('for_athletes');
            $table->string('answere_Video', 255);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_queston');
    }
};
