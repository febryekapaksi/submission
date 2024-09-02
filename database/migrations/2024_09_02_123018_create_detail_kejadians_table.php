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
        Schema::create('detail_kejadian', function (Blueprint $table) {
            $table->string('id')->primary(); // Menggunakan string ID sebagai primary key
            $table->string('bulan_pelaporan_id');
            $table->string('quarter_id');
            $table->date('tanggal_kejadian');
            $table->date('tanggal_ditemukan');
            $table->text('deskripsi_kejadian');
            $table->text('deskripsi_penyebab');

            $table->foreign('bulan_pelaporan_id')->references('id')->on('bulan_master')->onDelete('cascade');
            $table->foreign('quarter_id')->references('id')->on('quarter_master')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_kejadian');
    }
};
