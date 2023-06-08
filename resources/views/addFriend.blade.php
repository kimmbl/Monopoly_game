@extends('layouts.template')

@section('title-text', 'Пошук друга')
@section('link-css')
    <link rel="stylesheet" href="{{ asset('css/friends.css') }}">
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Пошук друга
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{route('searchFriends')}}" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="search_request"
                                   placeholder="Введіть ім'я або електронну адресу">
                            <input type="hidden" name="route" value="friends">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Шукати</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            @if($empty)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        Пошук не дав результатів
                    </div>
                </div>
                <br>
            @endif
            @if($users)
                @foreach($users as $user)
                    @if($user->id == Auth::id())
                        @continue
                    @endif
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="info container">
                                <img class="friend-avatar" src="{{$user->avatar}}">
                                <a href="{{route('profile', ['id' => $user->id])}}"><p
                                        class="friend-name">{{$user->name}}</p></a>
                                <div class="right-info">
                                    <form method="POST" action="{{route('add_friend')}}">
                                        @csrf
                                        <input name="id" type="hidden" value="{{$user->id}}">
                                        <input name="route" type="hidden" value="add">
                                        <button type="submit" class="btn btn-outline-success">Додати в друзі
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div><br>
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>
