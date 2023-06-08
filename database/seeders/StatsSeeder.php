<?php

namespace Database\Seeders;

use App\Models\Stats;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::table('users')->get();
        foreach ($users as $user) {
            Stats::create([
                'user_id' => $user->id,
            ]);
        }
    }
}
