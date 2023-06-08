<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class InventoryController extends Controller
{
    public function show(){

        $items = DB::table('items')
            ->join('inventories', function($join) {
                $join->on('items.id', '=', 'inventories.item_id')
                    ->where('inventories.user_id', '=', Auth::id());
            })
            ->get();

        return view('inventory', [
            'items' => $items
        ]);
    }

    public function changeActive(Request $request){
        $id = $request->input('item_id');
        $type = $request->input('item_type');

        if($type == 'dice'){
            $column = 'is_chosen_dice';
        } else {
            $column = 'is_chosen_pawn';
        }

        Inventory::where($column, 1)
            ->where('user_id', Auth::id())
            ->update([$column => 0]);

        $inv = Inventory::where('user_id', Auth::id())
            ->where('item_id', $id)
            ->update([$column => 1]);

        return Redirect::route('inventory');
    }
}
