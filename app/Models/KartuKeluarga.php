<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KartuKeluarga extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'nomor_kk',
        'alamat',
        'rt',
        'rw',
    ];

    /**
     * Relasi: Satu Kartu Keluarga memiliki banyak Penduduk.
     */
    public function penduduk(): HasMany
    {
        return $this->hasMany(Penduduk::class);
    }
}