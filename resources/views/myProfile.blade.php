@extends('layouts.template')
@section('title-text', 'Мій профіль')

@section('link-css')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Мій профіль
        </h2>
    </x-slot>

    @if($action != '')
        <div class="alert alert-success" role="alert">
            Зміни збережено
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row">
                            <div class="col-3">
                                <div class="crop">
                                    <img src="{{$user->avatar}}">
                                </div>
                                <p style="font-size: 30px">{{$user->name}}</p>
                            </div>
                            <div class="col-9" style="text-align: left; font-size: 15px">
                                <p style="font-size: 20px">Інформація</p>
                                <hr>
                                <p>Твій email: {{$user->email}}</p>
                                <p>Партій зіграно: {{$stats->games_played}}, з них виграно: {{$stats->games_won}}</p>
                                <p>Блокувань чату: {{$stats->banned_times}}</p>
                                <p>Місій виконано: {{$stats->missions_completed}}</p>
                                <p>Повідомлень надіслано: {{$stats->messages_sent}}</p>
                                <hr>
                                <a class="btn btn-success" href="/editProfile">Змінити профіль</a>
                                <button class="btn btn-success" onclick="showForm()">Змінити пароль</button>
                                <form id="change-password" method="POST" style="padding-top: 5px; display: none"
                                      onsubmit="checkPassword()"
                                      action="{{route('change_password', ['id' => Auth::id()])}}">
                                    @method('PUT')
                                    @csrf
                                    <input style="border-radius: 10px" id="pswd1" type="password" name="password"
                                           placeholder="Введіть новий пароль..." required>
                                    <input style="border-radius: 10px" id="pswd2" type="password"
                                           placeholder="Підтвердьте пароль..." required>
                                    <button class="btn btn-outline-success" type="submit">Зберегти</button>
                                    <p id="not-match" style="display: none; color: red">Паролі не співпадають</p>
                                    <p id="too-small" style="display: none; color: red">Пароль не може бути коротшим ніж 8 символів</p>
                                    <p id="too-big" style="display: none; color: red">Пароль не може бути довшим ніж 20 символів</p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@section('link-script')
    <script>
        function showForm() {
            var x = document.getElementById("change-password");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        function checkPassword() {
            var pw1 = document.getElementById("pswd1");
            var pw2 = document.getElementById("pswd2");
            pw1.style.borderColor = "red";
            pw2.style.borderColor = "red";

            if (pw1.value.length < 8) {
                document.getElementById('too-small').style.display = "block";
                document.getElementById('too-big').style.display = "none";
                document.getElementById('not-match').style.display = "none";
                event.preventDefault();
            } else if (pw1.value.length > 20) {
                document.getElementById('too-small').style.display = "none";
                document.getElementById('too-big').style.display = "block";
                document.getElementById('not-match').style.display = "none";
                event.preventDefault();
            } else if (pw1.value != pw2.value) {
                document.getElementById('too-small').style.display = "none";
                document.getElementById('too-big').style.display = "none";
                document.getElementById('not-match').style.display = "block";
                event.preventDefault();
            } else {
                document.getElementById('too-small').style.display = "none";
                document.getElementById('too-big').style.display = "none";
                document.getElementById('not-match').style.display = "none";
                pw2.style.borderColor = "gray";
                pw1.style.borderColor = "gray";

                return true;
            }
        }

        setTimeout(function () {
            $('.alert').alert('close');
        }, 4000);
    </script>
@endsection
