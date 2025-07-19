<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'thumbnail',
        'category',
        'user_id',
        'status',
        'published_date',
        'views',
    ];

    protected $casts = [
        'published_date' => 'datetime',
    ];

    /**
     * Relasi ke model User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessor untuk URL thumbnail.
     * Menggunakan Attribute class baru untuk getter & setter.
     */
    protected function thumbnailUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->getAttribute('thumbnail')
            ? Storage::url('public/articles/' . $this->getAttribute('thumbnail'))
            : asset('assets/img/placeholder.png'), // Ganti dengan placeholder Anda
        );
    }

    /**
     * Accessor untuk tanggal terbit yang sudah diformat.
     */
    protected function formattedPublishedDate(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->getAttribute('published_date')
            ? $this->getAttribute('published_date')->format('d F Y')
            : 'Belum Diterbitkan',
        );
    }

    /**
     * Accessor untuk preview konten.
     */
    protected function previewContent(): Attribute
    {
        return Attribute::make(
            get: fn() => Str::limit(strip_tags($this->getAttribute('content')), 150, '...'),
        );
    }
}