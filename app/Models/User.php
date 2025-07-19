<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute; // <-- Pastikan ini ada
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage; // <-- Pastikan ini ada

class User extends Authenticatable implements MustVerifyEmail
{
  use HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'email_verified_at',
    'password',
    'role',
    'profile_photo_path',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  /**
   * The accessors to append to the model's array form.
   *
   * @var array<int, string>
   */
  protected $appends = [
    'profile_photo_url', // <-- TAMBAHKAN INI
  ];

  /**
   * Get the URL to the user's profile photo.
   */
  public function getProfilePhotoUrlAttribute(): string
  {
    if ($this->profile_photo_path) {
      // Cek apakah path dimulai dengan 'avatars/' (ini adalah foto default)
      if (str_starts_with($this->profile_photo_path, 'avatars/')) {
        return asset('assets/img/' . $this->profile_photo_path);
      }

      // Jika tidak, ini adalah foto custom yang diupload ke storage
      return url('storage/' . $this->profile_photo_path);
    }

    // Fallback jika 'profile_photo_path' null (sebagai pengaman)
    return asset('assets/img/avatars/1.png');
  }

  /**
   * ✅ GUNAKAN ACCESSOR FLEKSIBEL INI:
   * Secara otomatis membuat URL lengkap untuk avatar dari storage ATAU assets.
   */
  protected function avatarUrl(): Attribute
  {
    return Attribute::make(
      get: function () {
        $path = $this->profile_photo_path;

        // 1. Cek jika kolom 'profile_photo_path' tidak kosong.
        if ($path) {
          // 2. Prioritaskan cek di 'storage'. 
          //    Ini untuk avatar yang diunggah oleh pengguna.
          if (Storage::disk('public')->exists($path)) {
            return Storage::url($path);
          }

          // 3. Jika tidak ada di 'storage', anggap ini adalah file statis di 'assets'.
          //    Ini untuk data avatar lama Anda (misal: '1.png', '2.png').
          return asset('assets/img/' . $path);
        }

        // 4. Jika 'profile_photo_path' kosong, gunakan avatar default.
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=random&color=fff';
      }
    );
  }
}