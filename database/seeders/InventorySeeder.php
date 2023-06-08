<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\User;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach($users as $user){
            Inventory::create(
                [
                    'user_id' => $user->id,
                    'item_id' => 7,
                    'is_chosen_pawn' => 1
                ]
            );
            Inventory::create(
                [
                    'user_id' => $user->id,
                    'item_id' => 8,
                    'is_chosen_dice' => 1
                ]
            );
        }
    }
}
