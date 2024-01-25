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
        Schema::create('vedio', function (Blueprint $table) {
            $table->id('vedio_id');
            $table->string('vedio_titel', 255);
            $table->string('vedio', 255);
            $table->enum('vedio_type', ['0', '1'])->default(0)->comment('1 => paid', '0=>free');
            $table->bigInteger('vedio_veiw_count');
            $table->string('vedio_ext', 255);
            $table->enum('vedio_status', ['0', '1'])->default(1)->comment('1 => Active', '0=>InActive');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vedio');
    }
};
