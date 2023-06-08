@extends('layouts.template')
@section('title-text', 'Панель Адміна')
@section('link-css')
    <link rel="stylesheet" href="{{ asset('css/adminPanel.css') }}">
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Панель Адміна') }}
        </h2>
    </x-slot>

    @if($alert != 'none')
        <div class="alert alert-success" role="alert">
            {{$alert}}
        </div>
    @endif



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{route('searchUser')}}" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="search_request" placeholder="Введіть ім'я або email...">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Пошук</button>
                            </div>
                        </div>
                    </form>

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Ім'я</th>
                            <th scope="col">Email</th>
                            <th scope="col">Роль</th>
                            <th scope="col">Обмеження</th>
                            <th scope="col">Дії</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            @if($user->name != 'System')
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    @if($user->is_admin)
                                        <td style="color: #7A4B09">Admin</td>
                                    @elseif($user->is_moderator)
                                        <td style="color: red">Moderator</td>
                                    @else
                                        <td>Користувач</td>
                                    @endif
                                    @if($user->is_banned)
                                        <td>Заблокований</td>
                                    @elseif($user->is_muted)
                                        <td>Заглушений</td>
                                    @else
                                        <td>Відсутні</td>
                                    @endif
                                    <td>
                                        @if($user->id != Auth::id() && !($user->is_admin))
                                            @if(!($user->is_muted))
                                                <form action="{{route('mute')}}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <button class="btn-sm btn-outline-info" type="submit">Замутити
                                                    </button>
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                </form>
                                            @else
                                                <form action="{{route('unmute')}}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <button class="btn-sm btn-outline-info" type="submit">Розмутити
                                                    </button>
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                </form>
                                            @endif
                                            @if(!($user->is_banned))
                                                <form action="{{route('ban')}}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <button class="btn-sm btn-outline-danger" type="submit">Заблокувати
                                                    </button>
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                </form>
                                            @else
                                                <form action="{{route('unban')}}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <button class="btn-sm btn-outline-danger" type="submit">Розблокувати
                                                    </button>
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                </form>
                                            @endif
                                            @if(!($user->is_moderator))
                                                <form action="{{route('addModer')}}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <button class="btn-sm btn-outline-success" type="submit">Зробити модератором
                                                    </button>
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                </form>
                                            @else
                                                <form action="{{route('removeModer')}}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <button class="btn-sm btn-outline-success" type="submit">Забрати права модератора
                                                    </button>
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                </form>
                                            @endif
                                        @elseif($user->id == Auth::id())
                                            Адмін
                                        @else
                                            Ви не можете нічого зробити з іншим адміном
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@section('link-script')
    <script>
        setTimeout(function () {
            $('.alert').alert('close');
        }, 4000);
    </script>
@endsection
