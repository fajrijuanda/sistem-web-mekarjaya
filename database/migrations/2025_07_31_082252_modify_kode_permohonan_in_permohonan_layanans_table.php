<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('permohonan_layanans', function (Blueprint $table) {
            // Mengubah kolom menjadi nullable dan menghapus constraint unique
            // karena tidak bisa ada banyak nilai NULL jika kolomnya unique.
            $table->string('kode_permohonan')->nullable()->unique(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permohonan_layanans', function (Blueprint $table) {
            // Mengembalikan ke kondisi semula jika diperlukan
            $table->string('kode_permohonan')->nullable(false)->unique()->change();
        });
    }
};
