@extends('layouts.template')
@section('title-text', 'Мій профіль')

@section('link-css')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Профіль гравця
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row">
                            <div class="col-3">
                                <div class="crop">
                                    <img class="img-avatar" src="{{$user->avatar}}">
                                </div>
                                <p style="font-size: 30px">{{$user->name}}</p>
                            </div>
                            <div class="col-9" style="text-align: left; font-size: 15px">
                                <p style="font-size: 20px">Інформація про гравця</p>
                                <hr>
                                <p>Email: {{$user->email}}</p>
                                <p>Партій зіграно: {{$stats->games_played}}, з них виграно: {{$stats->games_won}}</p>
                                <p>Блокувань чату: {{$stats->banned_times}}</p>
                                <p>Місій виконано: {{$stats->missions_completed}}</p>
                                <p>Повідомлень надіслано: {{$stats->messages_sent}}</p>
                                <hr>
                                @if(!$is_friends)
                                    <form method="POST" action="{{route('add_friend')}}">
                                        @csrf
                                        <input name="id" type="hidden" value="{{$user->id}}">
                                        <button type="submit" class="btn btn-success">Додати в друзі</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{route('delete_friend')}}">
                                        @method('DELETE')
                                        @csrf
                                        <input name="id" type="hidden" value="{{$user->id}}">
                                        <input name="route" type="hidden" value="profile">
                                        <button type="submit" class="btn btn-outline-success">Видалити з друзів
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
