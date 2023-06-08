<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Models\Friends;
use App\Models\Stats;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function show($id, Request $request)
    {
        $user = DB::table('users')->where('id', $id)->first();
        $stats = Stats::where('user_id', $id)->first();
        if ($user == null) {
            return view('error');
        } else if ($user->id == Auth::id()) {
            return view('myProfile', [
                'user' => $user,
                'stats' => $stats,
                'action' => $request->action
            ]);
        } else {
            $friend = Friends::where('user_id', Auth::id())
                ->where('friend_id', $user->id)->first();

            $friend ? $is_friends = true : $is_friends = false;

            return view('profile', [
                'user' => $user,
                'stats' => $stats,
                'is_friends' => $is_friends
            ]);
        }
    }

    public function showPlayers($alert = 'none')
    {
        $user = User::all();

        return view('adminPanel', [
            'users' => $user,
            'alert' => $alert
        ]);
    }

    public function mute(Request $request)
    {
        $user = User::find($request->input('user_id'));
        $user->is_muted = 1;
        $user->save();

        $alert = 'Користувач ' . $user->name . ' був заблокований в чаті.';
        return $this->showPlayers($alert);
    }

    public function ban(Request $request)
    {
        $user = User::find($request->input('user_id'));
        $user->is_banned = 1;
        $user->save();

        $alert = 'Користувач ' . $user->name . ' був заблокований.';
        return $this->showPlayers($alert);
    }

    public function addModer(Request $request)
    {
        $user = User::find($request->input('user_id'));
        $user->is_moderator = 1;
        $user->save();

        $alert = 'Користувач ' . $user->name . ' отримав права модератора.';
        return $this->showPlayers($alert);
    }

    public function unmute(Request $request)
    {
        $user = User::find($request->input('user_id'));
        $user->is_muted = 0;
        $user->save();

        $alert = 'Користувач ' . $user->name . ' був розблокований в чаті.';
        return $this->showPlayers($alert);
    }

    public function unban(Request $request)
    {
        $user = User::find($request->input('user_id'));
        $user->is_banned = 0;
        $user->save();

        $alert = 'Користувач ' . $user->name . ' був розблокований.';
        return $this->showPlayers($alert);
    }

    public function removeModer(Request $request)
    {
        $user = User::find($request->input('user_id'));
        $user->is_moderator = 0;
        $user->save();

        $alert = 'Користувача ' . $user->name . ' позбавлено прав модератора.';
        return $this->showPlayers($alert);
    }

    public function searchUser(Request $request)
    {
        $users = DB::table('users')
            ->where('name', 'like', '%' . $request->input('search_request') . '%')
            ->orWhere('email', 'like', '%' . $request->input('search_request') . '%')
            ->get();

        $alert = 'none';

        return view('adminPanel', [
            'users' => $users,
            'alert' => $alert
        ]);
    }

    public function changePassword(Request $request)
    {
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return Redirect::route('profile', ['id' => Auth::id(), 'action' => 'done']);
    }

    public function editProfile(UserEditRequest $request)
    {
        $validated = $request->validated();


        $user = User::find(Auth::id());


        $imagename = Str::random(25);
        if ($request->avatar) {
            $imagename = $imagename . '.' . $request->avatar->getClientOriginalExtension();
            Storage::disk('avatar')->put($imagename, file_get_contents($request->avatar));
            $user->avatar = '/img/avatars/' . $imagename;
        }

        if ($request->name)
            $user->name = $request->name;

        if ($request->email)
            $user->email = $request->email;

        $user->save();
        return Redirect::route('profile', ['id' => Auth::id(), 'action' => 'done']);
    }
}
