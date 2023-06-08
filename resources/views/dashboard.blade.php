@extends('layouts.template')

@section('title-text', 'Головна сторінка')

@section('link-css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Головна сторінка') }}
        </h2>
    </x-slot>

    <div class="container" style="padding-top: 40px">
        <div class="row">
            <div class="col-3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 bg-white text-center">
                        @for($i = 0; $i < 3; $i++)
                            @if($missions[$i]->hidden != 1)
                                <b><h5 style="padding-top: 10px">{{ $missions[$i]->name }}</h5></b>
                                <p style="font-size: 13px">{{ $missions[$i]->description }}</p>
                                <progress class="missions" max="{{ $missions[$i]->goal }}"
                                          value="{{ $missions[$i]->actual }}"></progress>
                                @if($i != 2)
                                    <div class="border-gray-500 border-b" style="padding-top: 10px"></div>
                                @endif
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 bg-white">
                        @php
                            $timenow = \Carbon\Carbon::now()->locale('uk_UK');
                        @endphp
                        <strong>Сьогодні: {{ $timenow->isoFormat('dddd, DD MMMM YYYY') }}</strong><br>
                        <strong>Інформація: </strong><strong style="color: red">сайт працює в тестовому режимі</strong>
                    </div>
                </div>
                <br>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 bg-white" id="app">
                        <div class="container chat-container card" aria-placeholder="Чат порожній" id="card-chat">
                                <chat-messages :messages="messages" style="font-family: 'Nunito', sans-serif;"></chat-messages>
                        </div>
                        @if(!Auth::user()->is_muted)
                            <chat-form v-on:messagesent="addMessage" :user="{{ Auth::user() }}"></chat-form>
                        @else
                            <p class="warning-chat">Ви заглушені, ви не можете писати повідомлення</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
