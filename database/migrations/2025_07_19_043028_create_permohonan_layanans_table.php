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
        Schema::create('permohonan_layanans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_permohonan')->unique(); // Kode unik, misal: LY-20250719-001
            $table->foreignId('penduduk_id')->constrained()->onDelete('cascade'); // Siapa pemohonnya
            $table->foreignId('jenis_layanan_id')->constrained()->onDelete('cascade'); // Layanan apa yang diajukan
            $table->enum('status', ['Diajukan', 'Diproses', 'Selesai', 'Ditolak'])->default('Diajukan');
            $table->text('keterangan_pemohon')->nullable(); // Catatan dari pemohon
            $table->text('catatan_admin')->nullable(); // Catatan dari admin jika ditolak
            $table->json('berkas')->nullable();
            $table->json('form_data')->nullable();
            $table->timestamp('tanggal_selesai')->nullable(); // Kapan permohonan selesai/ditolak
            $table->timestamps(); // Kapan permohonan dibuat (created_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_layanans');
    }
};
