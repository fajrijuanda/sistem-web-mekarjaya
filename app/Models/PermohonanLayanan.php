<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PermohonanLayanan extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'kode_permohonan',
        'penduduk_id',
        'jenis_layanan_id',
        'status',
        'keterangan_pemohon',
        'catatan_admin',
        'berkas', // Menyimpan informasi berkas yang diunggah
        'form_data', // <-- TAMBAHKAN INI: Untuk data dinamis form
        'tanggal_selesai',
    ];

    /**
     * Melakukan casting tipe data.
     */
    protected $casts = [
        'tanggal_selesai' => 'datetime',
        'berkas' => 'array', // Pastikan berkas juga di-cast
        'form_data' => 'array', // <-- TAMBAHKAN INI: Cast form_data ke array/json
    ];

    /**
     * Relasi: Satu Permohonan dimiliki oleh satu Penduduk.
     */
    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(Penduduk::class);
    }

    /**
     * Relasi: Satu Permohonan merujuk pada satu Jenis Layanan.
     */
    public function jenisLayanan(): BelongsTo
    {
        return $this->belongsTo(JenisLayanan::class);
    }
}