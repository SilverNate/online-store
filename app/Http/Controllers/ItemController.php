<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function GetAllItems(Request $request)
    {
        $Items = Item::All();

        return response()->json($Items);

    }

    public function GetItemDetails(Request $request)
    {
        $Items = Item::find($request->id);

        return response()->json($Items);
    }

}
