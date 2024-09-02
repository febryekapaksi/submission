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
        Schema::create('terkena_dampak_divisi', function (Blueprint $table) {
            $table->string('kerugian_id');
            $table->string('divisi_id');
            $table->timestamps();

            $table->foreign('kerugian_id')->references('id')->on('detail_kerugian')->onDelete('cascade');
            $table->foreign('divisi_id')->references('id')->on('divisi_master')->onDelete('cascade');

            $table->primary(['kerugian_id', 'divisi_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terkena_dampak_divisi');
    }
};
