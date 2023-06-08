@extends('layouts.template')
@section('title-text', 'Редагування профілю')
@section('link-css')
    <link rel="stylesheet" href="{{ asset('css/editForm.css') }}">
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xxl text-gray-800 leading-tight">
            Редагування профілю гравця {{Auth::user()->name}}
        </h2>
    </x-slot>


    <div class="py-6"></div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form method="POST" action="{{route('edit_profile')}}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <label for="exampleInputPassword1">Ім'я</label>
                    <input id="name" type="text" name="name" class="form-control" oninput="hideName()"
                           @error('name') style="border-color: red" @enderror>
                    @error('name')
                    <p id="error-name" style="color: red">{{ $errors->first('name') }}</p>
                    @enderror
                    <label for="exampleInputEmail1">Email</label>
                    <input id="email" type="email" name="email" class="form-control" oninput="hideEmail()"
                           @error('email') style="border-color: red" @enderror>
                    @error('email')
                    <p id="error-email" style="color: red">{{ $errors->first('email') }}</p>
                    @enderror
                    <label for="exampleInputPassword1">Аватар</label><br>
                    <input type="file" name="avatar" class="input-group-sm" style="border: black">
                    @error('avatar')
                    <p id="error-avatar" style="color: red">{{ $errors->first('avatar') }}</p>
                    @enderror
                    <br>
                    <button type="submit" class="btn btn-lg btn-success">Зберегти</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

@section('link-script')
    <script>
        function hideName() {
            document.getElementById('name').style.borderColor = '#D7CBD0';
            document.getElementById('error-name').style.display = 'none';
        }

        function hideEmail() {
            document.getElementById('email').style.borderColor = '#D7CBD0';
            document.getElementById('error-email').style.display = 'none';
        }
    </script>
@endsection
