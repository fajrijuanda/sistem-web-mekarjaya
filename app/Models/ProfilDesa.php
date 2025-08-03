<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    use HasFactory;

    protected $table = 'profil_desa'; // Nama tabel yang kita buat

    protected $fillable = [
        'konten', // Izinkan pengisian massal untuk kolom 'konten'
    ];

    /**
     * Atribut yang harus di-cast.
     *
     * @var array
     */
    protected $casts = [
        'konten' => 'array', // Otomatis konversi JSON ke Array dan sebaliknya
    ];
}