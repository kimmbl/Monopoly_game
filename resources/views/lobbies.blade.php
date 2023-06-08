@extends('layouts.template')

@section('title-text', 'Ігрові кімнати')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ігрові кімнати') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($active_lobby)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p style="font-size: xx-large; color: red;">Ви в активній грі!</p>
                        <a class="btn btn-lg btn-danger" href="{{route('joinGame', ['id' => $active_lobby->token])}}">Приєднатися до активної гри</a>
                </div>
            </div><br>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                        <form method="POST" action="{{route('createLobby')}}">
                            @method('POST')
                            @csrf
                            <button class="btn btn-lg btn-info" id="btn-chat" type="sumbit">
                                Нова ігрова кімната
                            </button>
                        </form>
                </div>
            </div>
            <br>
            @forelse($lobbies as $lobby)
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    <div style="text-align: center">
                        Ігрова кімната #{{$lobby->id}}
                    </div>
                    <div class="input-group">
                        <form method="POST">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="lobby" value="{{$lobby->id}}">
                            <button class="btn btn-lg btn-info" id="btn-chat" @click="joinLobby">
                                Увійти
                            </button>
                        </form>

                    </div>
                </div><br>
            @empty
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    Ігрових кімнат немає
                </div>
            @endforelse
            <dialog id="lobby-exist" style="display: none; border-radius: 10px; border-color: gray; background-color: gainsboro;" open>
                @if(session('alert') == 'lobby_exists')
                    <p>Ви не можете створити нову ігрову кімнату, оскільки ви вже перебуваєте в активній. Вийдіть і повторіть спробу.</p>
                @elseif(session('alert')== 'places_taken')
                    <p>Ви не можете увійти в цю ігрову кімнату, тому що там немає вільних місць. Вийдіть і повторіть спробу.</p>
                @elseif(session('alert')== 'cant_enter')
                    <p>Ви не можете увійти в ігрову кімнату, тому що ви вже є в активній. Вийдіть і повторіть спробу.</p>
                @endif()
                <p>
                    <button class="btn btn-sm btn-danger" id="closeDialog">Закрити</button>
                </p>
            </dialog>
        </div>
    </div>
</x-app-layout>

@section('link-script')
    <script>
        var dialog = document.getElementById('lobby-exist')
        var button = document.getElementById('closeDialog')
        if ('{{session('alert')}}') {
            dialog.style.display = 'inline';
        }

        button.onclick = function () {
            dialog.style.display = 'none';
        }
    </script>
@endsection
