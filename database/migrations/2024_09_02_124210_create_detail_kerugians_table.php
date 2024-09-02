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
        Schema::create('detail_kerugian', function (Blueprint $table) {
            $table->string('id')->primary(); // Menggunakan string ID sebagai primary key
            $table->decimal('kerugian_financial', 15, 2)->nullable();
            $table->decimal('potensial_kerugian_financial', 15, 2)->nullable();
            $table->string('status')->nullable();
            $table->text('kerugian_non_financial')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_kerugian');
    }
};
