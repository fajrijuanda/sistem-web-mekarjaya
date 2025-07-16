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
}