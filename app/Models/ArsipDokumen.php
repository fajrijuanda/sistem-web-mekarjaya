<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/ArsipDokumen.php
namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ArsipDokumen extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_dokumen',
        'nomor_dokumen',
        'kategori',
        'nama_file',
        'tipe_file',
        'ukuran_file',
        'user_id',
        'tanggal_unggah'
    ];

    protected $casts = [
        'tanggal_unggah' => 'date',
        'ukuran_file' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function fileUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => Storage::url('arsip-dokumen/' . $this->nama_file)
        );
    }

    protected function formattedTanggalUnggah(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->tanggal_unggah->isoFormat('D MMMM YYYY')
        );
    }

    protected function formattedUkuranFile(): Attribute
    {
        return Attribute::make(get: function () {
            $size = $this->ukuran_file;
            if ($size < 1024)
                return "{$size} B";
            $size /= 1024;
            if ($size < 1024)
                return round($size, 2) . ' KB';
            $size /= 1024;
            if ($size < 1024)
                return round($size, 2) . ' MB';
            $size /= 1024;
            return round($size, 2) . ' GB';
        });
    }
}