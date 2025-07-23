<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisLayanan extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'kategori_layanan_id',
        'nama_layanan',
        'deskripsi',
        'syarat_pengajuan',
    ];

    /**
     * Relasi: Satu Jenis Layanan dimiliki oleh satu Kategori Layanan.
     */
    public function kategoriLayanan(): BelongsTo
    {
        return $this->belongsTo(KategoriLayanan::class);
    }

    /**
     * Relasi: Satu Jenis Layanan bisa memiliki banyak Permohonan.
     */
    public function permohonanLayanan(): HasMany
    {
        return $this->hasMany(PermohonanLayanan::class);
    }
}