<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class KategoriLayanan extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];

    /**
     * Relasi: Satu Kategori memiliki banyak Jenis Layanan.
     */
    public function jenisLayanan(): HasMany
    {
        return $this->hasMany(JenisLayanan::class);
    }

    public function permohonanLayanans(): HasManyThrough
    {
        return $this->hasManyThrough(PermohonanLayanan::class, JenisLayanan::class);
    }
}