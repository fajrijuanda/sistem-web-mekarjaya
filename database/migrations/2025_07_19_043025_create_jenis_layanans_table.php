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
        Schema::create('jenis_layanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_layanan_id')->constrained()->onDelete('cascade');
            $table->string('nama_layanan'); // Contoh: 'Surat Pengantar Nikah'
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->text('syarat_pengajuan')->nullable(); // Dokumen apa saja yang diperlukan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_layanans');
    }
};
