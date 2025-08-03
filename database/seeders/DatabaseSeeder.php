<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call([
      SuperAdminSeeder::class,
      AdminPelayananSeeder::class,
      AdminKontenSeeder::class,
      KategoriLayananSeeder::class,
      JenisLayananSeeder::class,
      ProfilDesaSeeder::class,
    ]);

    User::factory(10)->create();
  }
}
