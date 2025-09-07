<?php

namespace Modules\Ishoe\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Ishoe\Models\Shoe;
use Modules\Ishoe\Repositories\ShoeRepository;

class InitialShoesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    if (Shoe::count() == 0) {
      $repository = app(ShoeRepository::class);
      $repository->create([
        'reference' => 'SH-001',
        'base_price' => 100,
        'en' => ['title' => 'Classic Shoe'],
        'es' => ['title' => 'Zapato Clásico'],
      ]);
    }
  }
}
