<?php

namespace App\Observers;

use App\Models\Inventory;
use App\Models\Missions;
use App\Models\Stats;
use App\Models\UsersMissions;
use Illuminate\Support\Facades\Auth;

class StatsObserver
{
    public static $mission_id;

    /**
     * Handle the Stats "created" event.
     *
     * @param \App\Models\Stats $stats
     * @return void
     */
    public function created(Stats $stats)
    {
        //
    }

    /**
     * Handle the Stats "updating" event.
     *
     * @param \App\Models\Stats $stats
     * @return void
     */
    public function updating(Stats $stats)
    {
        if ($stats->isDirty('friends_added'))
            self::$mission_id = 1;
        elseif ($stats->isDirty('games_played'))
            self::$mission_id = 2;
        elseif ($stats->isDirty('games_won')) {
            $user_mission = UsersMissions::where('mission_id', 3)
                ->where('user_id', Auth::id())
                ->first();
            if (!$user_mission->is_done)
                self::$mission_id = 3;
            else
                self::$mission_id = 5;
        } elseif ($stats->isDirty('messages_sent'))
            self::$mission_id = 4;
        elseif ($stats->isDirty('banned_times'))
            self::$mission_id = 6;
    }

    /**
     * Handle the Stats "updated" event.
     *
     * @param \App\Models\Stats $stats
     * @return void
     */
    public function updated(Stats $stats)
    {

        $user_mission = UsersMissions::where('mission_id', self::$mission_id)
            ->where('user_id', Auth::id())
            ->first();


        if (!$user_mission->is_done) {
            $user_mission->actual++;

            $mission = Missions::find($user_mission->mission_id);

            if ($mission->goal == $user_mission->actual) {
                $user_mission->is_done = true;

                Inventory::create([
                    'user_id' => Auth::id(),
                    'item_id' => $mission->item_id
                ]);
            }
            $user_mission->save();
        }
    }


    /**
     * Handle the Stats "deleted" event.
     *
     * @param \App\Models\Stats $stats
     * @return void
     */
    public function deleted(Stats $stats)
    {
        //
    }

    /**
     * Handle the Stats "restored" event.
     *
     * @param \App\Models\Stats $stats
     * @return void
     */
    public function restored(Stats $stats)
    {
        //
    }

    /**
     * Handle the Stats "force deleted" event.
     *
     * @param \App\Models\Stats $stats
     * @return void
     */
    public function forceDeleted(Stats $stats)
    {
        //
    }
}
