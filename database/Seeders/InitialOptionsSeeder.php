<?php

namespace Modules\Ishoe\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Ishoe\Models\Option;
use Modules\Ishoe\Repositories\OptionRepository;

class InitialOptionsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // parent options
    if (Option::count() === 0) {
      $parents = [
        ['es' => 'Color', 'en' => 'Color'],
        ['es' => 'Material', 'en' => 'Material'],
        ['es' => 'Tamaño', 'en' => 'Size'],
      ];

      $repository = app(OptionRepository::class);
      foreach ($parents as $parent) {
        $option = $repository->create([
          'price' => 0,
          'parent_id' => 0,
          'pieces' => 1,
          'need_cutting' => false,
          'is_editable' => true,
          'en' => ['title' => $parent['en']],
          'es' => ['title' => $parent['es']],
        ]);

        // child options
        for ($i = 1; $i <= 2; $i++) {
          $repository->create([
            'price' => 10 * $i,
            'parent_id' => $option->id,
            'pieces' => 1,
            'need_cutting' => false,
            'is_editable' => true,
            'en' => ['title' => "{$parent['en']} Option {$i}"],
            'es' => ['title' => "{$parent['es']} Opción {$i}"],
          ]);
        }
      }
    }
  }
}
