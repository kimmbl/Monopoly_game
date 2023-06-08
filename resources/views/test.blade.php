@extends('layouts.template')

@section('link-css')
    @livewireStyles
@endsection

@section('title-text', 'Ігрові кімнати')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Test') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <livewire:test :user_id="Auth::id()"/>
        </div>
    </div>
</x-app-layout>

@section('link-script')
    @livewireScripts
@endsection
