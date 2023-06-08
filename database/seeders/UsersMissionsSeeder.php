<?php

namespace Database\Seeders;

use App\Models\UsersMissions;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersMissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $missions = DB::table('missions')->get();
        $users = DB::table('users')->get();
        foreach ($users as $user){
            foreach ($missions as $mission){
                UsersMissions::create([
                    'user_id' => $user->id,
                    'mission_id' => $mission-> id,
                ]);
            }
        }
    }
}
