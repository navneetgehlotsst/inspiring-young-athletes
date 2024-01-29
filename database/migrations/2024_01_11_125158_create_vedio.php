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
        Schema::create('Video', function (Blueprint $table) {
            $table->id('Video_id');
            $table->string('Video_titel', 255);
            $table->string('Video', 255);
            $table->enum('Video_type', ['0', '1'])->default(0)->comment('1 => paid', '0=>free');
            $table->bigInteger('Video_veiw_count');
            $table->string('Video_ext', 255);
            $table->enum('Video_status', ['0', '1'])->default(1)->comment('1 => Active', '0=>InActive');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Video');
    }
};
