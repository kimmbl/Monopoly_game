<?php

namespace Database\Seeders;

use App\Models\Missions;
use Illuminate\Database\Seeder;

class MissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $missions = [
            [
                'id' => 1,
                'name' => 'Привіт!',
                'description' => 'Додай 1 друга',
                'goal' => 1,
                'item_id' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Початок',
                'description' => 'Зіграй в одну гру',
                'goal' => 1,
                'item_id' => 2,
            ],
            [
                'id' => 3,
                'name' => 'Виграш!',
                'description' => 'Виграй 1 гру',
                'goal' => 1,
                'item_id' => 3,
            ],
            [
                'id' => 4,
                'name' => 'Комунікація',
                'description' => 'Напиши 100 повідомлень в головний чат',
                'goal' => 100,
                'item_id' => 4,
            ],
            [
                'id' => 5,
                'name' => 'Високий рівень',
                'description' => 'Виграй 5 ігор',
                'goal' => 5,
                'item_id' => 5,
            ],
            [
                'id' => 6,
                'name' => 'Тихо!',
                'description' => 'Отримай блокування чату',
                'goal' => 1,
                'item_id' => 6,
                'hidden' => true
            ]
        ];
        foreach ($missions as $mission){
            Missions::create($mission);
        }
    }
}
