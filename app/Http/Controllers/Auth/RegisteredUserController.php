<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Поле ":attribute" є обов\'язковим',
            'string' => 'Поле ":attribute" має бути текстовим',
            'email.email' => 'Поле "Email" містить неправильний символ',
            'min' => 'Поле "Пароль" надто коротке (мінімум 8 символів)',
            'email.unique' => 'Цей email вже зайнятий',
            'name.unique' => 'Це ім\'я вже зайняте',
            'password.confirmed' => 'Паролі не однакові'
        ];
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], $messages);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);


        DB::table('stats')->insert([
            'user_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        $missions = DB::table('missions')->get();

        foreach ($missions as $mission) {
            DB::table('users_missions')->insert([
                'mission_id' => $mission->id,
                'user_id' => Auth::id(),
            ]);
        }

        Inventory::create([
            'user_id' => Auth::id(),
            'item_id' => 7,
            'is_chosen_pawn' => 1
        ]);

        Inventory::create([
            'user_id' => Auth::id(),
            'item_id' => 8,
            'is_chosen_dice' => 1
        ]);

        return redirect(RouteServiceProvider::HOME);
    }
}
