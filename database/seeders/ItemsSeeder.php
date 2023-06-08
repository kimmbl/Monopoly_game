<?php

namespace Database\Seeders;

use App\Models\Items;
use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'id' => 1,
                'name' => 'Фішка "Трикутник"',
                'type' => 'pawn',
                'rarity' => 'ordinary',
                'img' => '/img/triangle_pawn.png',
                'shortname' => 'pawn_tri'
            ],
            [
                'id' => 2,
                'name' => 'Фішка "Зірка"',
                'type' => 'pawn',
                'rarity' => 'rare',
                'img' => '/img/stars_pawn.png',
                'shortname' => 'pawn_star'
            ],
            [
                'id' => 3,
                'name' => 'Кубики "Ліс"',
                'type' => 'dice',
                'rarity' => 'rare',
                'img' => '/img/forest_dice.png',
                'shortname' => 'dice_for'
            ],
            [
                'id' => 4,
                'name' => 'Кубики "Елегантність"',
                'type' => 'dice',
                'rarity' => 'secret',
                'img' => '/img/elegancy_dice.png',
                'shortname' => 'dice_eleg'
            ],
            [
                'id' => 5,
                'name' => 'Кубики "Весна"',
                'type' => 'dice',
                'rarity' => 'contraband',
                'img' => '/img/spring_dice.png',
                'shortname' => 'dice_spr'
            ],
            [
                'id' => 6,
                'name' => 'Фішка "Тихо!"',
                'type' => 'pawn',
                'rarity' => 'secret',
                'img' => '/img/silence_pawn.png',
                'shortname' => 'pawn_sil'
            ],
            [
                'id' => 7,
                'name' => 'Фішка стандартна',
                'type' => 'pawn',
                'rarity' => 'default',
                'img' => '/img/circle_pawn.png',
                'shortname' => 'pawn_def'
            ],
            [
                'id' => 8,
                'name' => 'Кубики стандартні',
                'type' => 'dice',
                'rarity' => 'default',
                'img' => '/img/white_dice.png',
                'shortname' => 'dice_def'
            ],
        ];
        foreach ($items as $item){
            Items::create($item);
        }
    }
}
