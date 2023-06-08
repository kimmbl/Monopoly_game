<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function show(){
        $missions = DB::table('missions')->join('users_missions', function($join) {
            $join->on('missions.id', '=', 'users_missions.mission_id')
                ->where('users_missions.user_id', '=', Auth::id());
        })->orderBy('is_done', 'ASC')->get();
        return view('dashboard', [
            'missions' => $missions,
        ]);
    }
}
