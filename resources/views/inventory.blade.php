@extends('layouts.template')
@inject('temp', 'App\Http\Controllers\InventoryController')
@section('title-text', 'Інвентар')
@section('link-css')
    <link rel="stylesheet" href="{{ asset('css/inventory.css') }}">
@endsection
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Інвентар') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white">
                    <h5>Ваші предмети:</h5><br>
                    @forelse($items as $item)
                        <div class="item-cell drpbtn"
                             @if(!($item->is_chosen_dice || $item->is_chosen_pawn)) onclick="chooseAction('{{$item->shortname}}')"@endif>
                            @if($item->is_chosen_dice || $item->is_chosen_pawn)
                                <img src="/img/active.png" class="inventory-active">
                            @endif
                            <div class="item-screen drpbtn"><img class="drpbtn" style="width: 148px;"
                                                                 src="{{ $item->img }}">
                            </div>
                            <div class="item-name drpbtn {{ $item->rarity }}">{{ $item->name }}</div>
                            <div id="{{$item->shortname}}" class="dropdown-content">
                                <form action="{{route('inventory_put')}}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <button class="btn-sm btn-success" type="submit">Активувати</button>
                                    <input type="hidden" name="item_id" value="{{$item->item_id}}">
                                    <input type="hidden" name="item_type" value="{{$item->type}}">
                                </form>
                            </div>
                        </div>
                    @empty
                        <p>У вас ще немає предметів</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@section('link-script')
    <script>
        function chooseAction(n) {
            document.getElementById(n).classList.toggle("show");
        }

        window.onclick = function (event) {
            if (!event.target.matches('.drpbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
@endsection
