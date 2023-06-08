<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //User::factory(10)->create();
        User::factory()->create([
            'id' => 0,
            'name' => 'System',
            'email' => 'system@ukr.net',
            'password' => 'абвгдeжзиіїйклмонпрстуфхцшщьюя'
        ]);
        User::factory()->create([
           'name' => 'Admin',
           'email' => 'admin@email.com',
           'password' => '$2y$10$Hc0Gp5j0Yn5SKycPdTicCOgc/k/eVR.jliaoRRiWdSdUD79LPPKSK', //123123123
            'is_admin' => true,
        ]);
        User::factory()->create([
            'name' => 'Moderator',
            'email' => 'moder@email.com',
            'password' => '$2y$10$Hc0Gp5j0Yn5SKycPdTicCOgc/k/eVR.jliaoRRiWdSdUD79LPPKSK',
            'is_moderator' => true
        ]);
        User::factory()->create([
            'name' => 'User',
            'email' => 'user@email.com',
            'password' => '$2y$10$Hc0Gp5j0Yn5SKycPdTicCOgc/k/eVR.jliaoRRiWdSdUD79LPPKSK'
        ]);


        $this->call(PropertiesSeeder::class);
        $this->call(ItemsSeeder::class);
        $this->call(MissionsSeeder::class);
        $this->call(UsersMissionsSeeder::class);
        $this->call(StatsSeeder::class);
        $this->call(InventorySeeder::class);
        $this->call(ChancesSeeder::class);
    }
}
