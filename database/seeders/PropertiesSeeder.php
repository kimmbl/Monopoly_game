<?php

namespace Database\Seeders;

use App\Models\Properties;
use Illuminate\Database\Seeder;
use PhpParser\Builder;

class PropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @mixin Builder
     * @return void
     */
    public function run()
    {
        $properties = [
            [
                'id' => 1,
                'name' => 'Старт',
                'price' => 0,
                'type' => 'corner',
                'family' => 'start'
            ],
            [
                'id' => 2,
                'name' => 'OKKO',
                'price' => 50,
                'rent' => 2,
                'house1' => 10,
                'house2' => 30,
                'house3' => 90,
                'house4' => 160,
                'star' => 250,
                'buy_house' => 50,
                'type' => 'field',
                'family' => 'prints'
            ],
            [
                'id' => 3,
                'name' => 'Шанс',
                'price' => 0,
                'type' => 'chance',
                'family' => 'chance'
            ],
            [
                'id' => 4,
                'name' => 'WOG',
                'price' => 60,
                'rent' => 4,
                'house1' => 20,
                'house2' => 60,
                'house3' => 180,
                'house4' => 320,
                'star' => 450,
                'buy_house' => 50,
                'type' => 'field',
                'family' => 'prints'
            ],
            [
                'id' => 5,
                'name' => 'Паркінг',
                'price' => 200,
                'type' => 'fine',
                'family' => 'fine'
            ],
            [
                'id' => 6,
                'name' => 'Спартак',
                'full_name' => 'ТРЦ Спартак',
                'price' => 200,
                'house1' => 25,
                'house2' => 50,
                'house3' => 100,
                'house4' => 200,
                'type' => 'field',
                'family' => 'science'
            ],
            [
                'id' => 7,
                'name' => 'Стрийський парк',
                'price' => 100,
                'rent' => 6,
                'house1' => 30,
                'house2' => 90,
                'house3' => 270,
                'house4' => 400,
                'star' => 550,
                'buy_house' => 75,
                'type' => 'field',
                'family' => 'sections'
            ],
            [
                'id' => 8,
                'name' => 'Шанс',
                'price' => 0,
                'type' => 'chance',
                'family' => 'chance'
            ],
            [
                'id' => 9,
                'name' => 'Погулянка',
                'price' => 100,
                'rent' => 6,
                'house1' => 30,
                'house2' => 90,
                'house3' => 270,
                'house4' => 400,
                'star' => 550,
                'buy_house' => 75,
                'type' => 'field',
                'family' => 'sections'
            ],
            [
                'id' => 10,
                'name' => 'Високий замок',
                'full_name' => 'Парк "Високий замок"',
                'price' => 120,
                'rent' => 8,
                'house1' => 40,
                'house2' => 100,
                'house3' => 300,
                'house4' => 450,
                'star' => 600,
                'buy_house' => 75,
                'type' => 'field',
                'family' => 'sections'
            ],
            [
                'id' => 11,
                'name' => 'ЦНАП',
                'price' => 0,
                'type' => 'corner',
                'family' => 'prison'
            ],
            [
                'id' => 12,
                'name' => 'Шувар',
                'full_name' => 'Ринок "Шувар"',
                'price' => 140,
                'rent' => 10,
                'house1' => 50,
                'house2' => 150,
                'house3' => 450,
                'house4' => 625,
                'star' => 750,
                'buy_house' => 100,
                'type' => 'field',
                'family' => 'club'
            ],
            [
                'id' => 13,
                'name' => 'Арена Львів',
                'full_name' => 'Стадіон "Арена Львів"',
                'price' => 150,
                'type' => 'field',
                'family' => 'webpage'
            ],
            [
                'id' => 14,
                'name' => 'Привокзальний',
                'full_name' => 'Ринок "Привокзальний"',
                'price' => 140,
                'rent' => 10,
                'house1' => 50,
                'house2' => 150,
                'house3' => 450,
                'house4' => 625,
                'star' => 750,
                'buy_house' => 100,
                'type' => 'field',
                'family' => 'club'
            ],
            [
                'id' => 15,
                'name' => 'Краківський',
                'full_name' => '"Краківський" ринок',
                'price' => 160,
                'rent' => 12,
                'house1' => 60,
                'house2' => 180,
                'house3' => 500,
                'house4' => 700,
                'star' => 900,
                'buy_house' => 100,
                'type' => 'field',
                'family' => 'club'
            ],
            [
                'id' => 16,
                'name' => 'Форум Львів',
                'price' => 200,
                'house1' => 25,
                'house2' => 50,
                'house3' => 100,
                'house4' => 200,
                'type' => 'field',
                'family' => 'science'
            ],
            [
                'id' => 17,
                'name' => 'Криївка',
                'price' => 180,
                'rent' => 14,
                'house1' => 70,
                'house2' => 200,
                'house3' => 550,
                'house4' => 750,
                'star' => 950,
                'buy_house' => 125,
                'type' => 'field',
                'family' => 'school'
            ],
            [
                'id' => 18,
                'name' => 'Шанс',
                'price' => 0,
                'type' => 'chance',
                'family' => 'chance'
            ],
            [
                'id' => 19,
                'name' => 'Панорама',
                'full_name' => 'Ресторан "Панорама"',
                'price' => 180,
                'rent' => 14,
                'house1' => 70,
                'house2' => 200,
                'house3' => 550,
                'house4' => 750,
                'star' => 950,
                'buy_house' => 125,
                'type' => 'field',
                'family' => 'school'
            ],
            [
                'id' => 20,
                'name' => 'Копальня кави',
                'full_name' => 'Львівська копальня кави',
                'price' => 200,
                'rent' => 16,
                'house1' => 80,
                'house2' => 220,
                'house3' => 600,
                'house4' => 800,
                'star' => 1000,
                'buy_house' => 125,
                'type' => 'field',
                'family' => 'school'
            ],
            [
                'id' => 21,
                'name' => 'Площа Ринок',
                'price' => 0,
                'type' => 'corner',
                'family' => 'free'
            ],
            [
                'id' => 22,
                'name' => 'Львівські круасани',
                'price' => 220,
                'rent' => 18,
                'house1' => 90,
                'house2' => 250,
                'house3' => 700,
                'house4' => 875,
                'star' => 1050,
                'buy_house' => 150,
                'type' => 'field',
                'family' => 'program'
            ],
            [
                'id' => 23,
                'name' => 'McDonalds',
                'price' => 220,
                'rent' => 18,
                'house1' => 90,
                'house2' => 250,
                'house3' => 700,
                'house4' => 875,
                'star' => 1050,
                'buy_house' => 150,
                'type' => 'field',
                'family' => 'program'
            ],
            [
                'id' => 24,
                'name' => 'Шанс',
                'price' => 0,
                'type' => 'chance',
                'family' => 'chance'
            ],
            [
                'id' => 25,
                'name' => 'KFC',
                'price' => 240,
                'rent' => 20,
                'house1' => 100,
                'house2' => 300,
                'house3' => 750,
                'house4' => 925,
                'star' => 1100,
                'buy_house' => 150,
                'type' => 'field',
                'family' => 'program'
            ],
            [
                'id' => 26,
                'name' => 'King Cross',
                'full_name' => 'King Cross Leopolis',
                'price' => 200,
                'house1' => 25,
                'house2' => 50,
                'house3' => 100,
                'house4' => 200,
                'type' => 'field',
                'family' => 'science'
            ],
            [
                'id' => 27,
                'name' => 'Сільпо',
                'price' => 260,
                'rent' => 22,
                'house1' => 110,
                'house2' => 330,
                'house3' => 800,
                'house4' => 975,
                'star' => 1150,
                'buy_house' => 175,
                'type' => 'field',
                'family' => 'classes'
            ],
            [
                'id' => 28,
                'name' => 'АТБ',
                'price' => 260,
                'rent' => 22,
                'house1' => 110,
                'house2' => 330,
                'house3' => 800,
                'house4' => 975,
                'star' => 1150,
                'buy_house' => 175,
                'type' => 'field',
                'family' => 'classes'
            ],
            [
                'id' => 29,
                'name' => 'Стадіон "Україна"',
                'full_name' => 'Стадіон "Україна"',
                'price' => 150,
                'type' => 'field',
                'family' => 'webpage'
            ],
            [
                'id' => 30,
                'name' => 'Близенько',
                'price' => 280,
                'rent' => 24,
                'house1' => 120,
                'house2' => 360,
                'house3' => 850,
                'house4' => 1025,
                'star' => 1200,
                'buy_house' => 175,
                'type' => 'field',
                'family' => 'classes'
            ],
            [
                'id' => 31,
                'name' => 'До ЦНАПу',
                'price' => 0,
                'type' => 'corner',
                'family' => 'go_to_prison'
            ],
            [
                'id' => 32,
                'name' => 'Grand Hotel',
                'price' => 300,
                'rent' => 26,
                'house1' => 130,
                'house2' => 390,
                'house3' => 900,
                'house4' => 1100,
                'star' => 1300,
                'buy_house' => 200,
                'type' => 'field',
                'family' => 'dormitory'
            ],
            [
                'id' => 33,
                'name' => 'Шанс',
                'price' => 0,
                'type' => 'chance',
                'family' => 'chance'
            ],
            [
                'id' => 34,
                'name' => 'Emeli Resort',
                'price' => 300,
                'rent' => 26,
                'house1' => 130,
                'house2' => 390,
                'house3' => 900,
                'house4' => 1100,
                'star' => 1300,
                'buy_house' => 200,
                'type' => 'field',
                'family' => 'dormitory'
            ],
            [
                'id' => 35,
                'name' => 'BankHotel',
                'price' => 320,
                'rent' => 28,
                'house1' => 150,
                'house2' => 450,
                'house3' => 1000,
                'house4' => 1200,
                'star' => 1450,
                'buy_house' => 200,
                'type' => 'field',
                'family' => 'dormitory'
            ],
            [
                'id' => 36,
                'name' => 'Ашан',
                'full_name' => 'Ашан',
                'price' => 200,
                'house1' => 25,
                'house2' => 50,
                'house3' => 100,
                'house4' => 200,
                'type' => 'field',
                'family' => 'science'
            ],
            [
                'id' => 37,
                'name' => 'Шанс',
                'price' => 0,
                'type' => 'chance',
                'family' => 'chance'
            ],
            [
                'id' => 38,
                'name' => 'Палац Потоцьких',
                'price' => 350,
                'rent' => 35,
                'house1' => 200,
                'house2' => 600,
                'house3' => 1200,
                'house4' => 1400,
                'star' => 1700,
                'buy_house' => 250,
                'type' => 'field',
                'family' => 'festival'
            ],
            [
                'id' => 39,
                'name' => 'Комуналка',
                'full_name' => 'Комунальні платежі',
                'price' => 100,
                'type' => 'fine',
                'family' => 'fine'
            ],
            [
                'id' => 40,
                'name' => 'Оперний театр',
                'price' => 400,
                'rent' => 50,
                'house1' => 300,
                'house2' => 700,
                'house3' => 1400,
                'house4' => 1700,
                'star' => 2000,
                'buy_house' => 250,
                'type' => 'field',
                'family' => 'festival'
            ],
        ];
        foreach($properties as $property){
            Properties::create($property);
        }
    }
}
