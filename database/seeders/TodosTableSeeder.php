<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Todo;

class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $param = [
          'user_id' => 1,
          'tag_id' => 1,
          'task_name' => 'Aをする'
      ];
      Todo::create($param);
      $param = [
          'user_id' => 1,
          'tag_id' => 2,
          'task_name' => 'Bをする'
      ];
      Todo::create($param);
      $param = [
          'user_id' => 1,
          'tag_id' => 3,
          'task_name' => 'Cに行く'
      ];
      Todo::create($param);
      $param = [
          'user_id' => 2,
          'tag_id' => 2,
          'task_name' => 'Dを食べる'
      ];
      Todo::create($param);
    }
}
