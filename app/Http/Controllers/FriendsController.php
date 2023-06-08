<?php

namespace App\Http\Controllers;

use App\Models\Friends;
use App\Models\Stats;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class FriendsController extends Controller
{
    public function showFriends()
    {
        $friends = DB::table('friends')
            ->join('users', 'friends.friend_id', '=', 'users.id')
            ->select('users.name', 'users.avatar', 'users.id')
            ->where('friends.user_id', Auth::id())
            ->get();

        $friends_count = Stats::find(Auth::id())->friends_added;

        return view('friends', [
            'friends' => $friends,
            'count' => $friends_count
        ]);
    }

    public function addFriend(Request $request)
    {
        $friends = new Friends();
        $stats = Stats::find(Auth::id());

        $friends->user_id = Auth::id();
        $friends->friend_id = $request->id;
        $stats->friends_added++;

        $friends->save();
        $stats->save();

        if ($request->route == "add")
            return Redirect::route('friends');
        else
            return Redirect::route('profile', ['id' => $request->id]);
    }

    public function deleteFriend(Request $request)
    {
        $friends = Friends::where('user_id', Auth::id())
            ->where('friend_id', $request->id);
        $stats = Stats::find(Auth::id());

        $stats->friends_added--;

        $friends->delete();
        $stats->save();

        if ($request->route == 'friends')
            return Redirect::route('friends');
        else
            return Redirect::route('profile', ['id' => $request->id]);
    }

    public function searchUser(Request $request)
    {
        if ($request->input('search_request') == "") {
            return view('addFriend', [
                'users' => null,
                'empty' => true
            ]);
        } else {

            $users = DB::table('users')
                ->where('users.name', 'like', '%' . $request->input('search_request') . '%')
                ->orWhere('users.email', 'like', '%' . $request->input('search_request') . '%')
                ->get();

            $friends = DB::table('friends')
                ->where('friends.user_id', Auth::id())
                ->get();


            foreach ($users as $user) {
                foreach ($friends as $friend) {
                    if ($user->id == $friend->friend_id)
                        $users->forget($user);
                }
                if ($user->id == 1)
                    $users->forget($user);
            }

            return view('addFriend', [
                'users' => $users,
                'empty' => $users->isEmpty()
            ]);
        }
    }
}
