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
        Schema::create('arsip_dokumens', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dokumen');
            $table->string('nomor_dokumen')->nullable();
            $table->string('kategori');
            $table->string('nama_file'); // Nama file yang tersimpan di storage
            $table->string('tipe_file');  // ekstensi atau tipe umum (pdf, image, docx)
            $table->unsignedBigInteger('ukuran_file'); // Ukuran dalam bytes
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal_unggah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_dokumens');
    }
};
