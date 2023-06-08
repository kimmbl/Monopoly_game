<?php

namespace Database\Seeders;

use App\Models\Chances;
use Illuminate\Database\Seeder;

class ChancesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chances = [
            [
                'text' => ' йде на Старт і отримує 200$.',
                'amount' => 200,
                'goto' => 1,
                'type' => 'go'
            ],
            [
                'text' => ' переходить до поля «АТБ». Якщо проходить через поле «Старт», то отримує 200$.',
                'amount' => 200,
                'goto' => 28,
                'type' => 'go'
            ],
            [
                'text' => ' переходить до поля "Оперний театр"',
                'goto' => 28,
                'type' => 'go'
            ],
            [
                'text' => ' сплачує штраф за перевищення швидкості - 100$.',
                'amount' => 100,
                'type' => 'ticket'
            ],
            [
                'text' => ' іде в ЦНАП за довідкою.',
                'goto' => 11,
                'type' => 'prison'
            ],
            [
                'text' => ' отримує 40$ через системну помилку.',
                'amount' => 40,
                'type' => 'gain'
            ],
            [
                'text' => ' викинув сміття на вулиці. Він повинен заплатити штраф у розмірі 50$.',
                'amount' => 50,
                'type' => 'ticket'
            ],
            [
                'text' => ' знайшов 50$ на вулиці.',
                'amount' => 50,
                'type' => 'gain'
            ],
            [
                'text' => ' йде на поле "Краківський". Якщо проходить через поле «Старт», то отримує 200$.',
                'amount' => 200,
                'goto' => 15,
                'type' => 'go'
            ],
            [
                'text' => ' купив сувенірів на 30$.',
                'amount' => 30,
                'type' => 'ticket'
            ],
            [
                'text' => ' виграв 400$ у лотереї',
                'amount' => 400,
                'type' => 'gain'
            ],
            [
                'text' => ' загубив паспорт. Оплата за відновлення - 100$.',
                'amount' => 100,
                'type' => 'ticket'
            ],
            [
                'text' => ' продав старі речі на OLX. Отримує 100$',
                'amount' => 100,
                'type' => 'gain'
            ],
            [
                'text' => ' роздавав листівки. Отримує 75$.',
                'amount' => 75,
                'type' => 'gain'
            ],
            [
                'text' => ' не оплатив проїзд в тролейбусі. Штраф 50$',
                'amount' => 50,
                'type' => 'gain'
            ],         
        ];

        foreach($chances as $chance){
            Chances::create($chance);
        }
    }
}
