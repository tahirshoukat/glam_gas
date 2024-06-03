<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search', '');

        $query = Item::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('location', 'like', '%' . $search . '%')
                ->orWhere('item_description', 'like', '%' . $search . '%');
        }

        $items = $query->paginate(10); // Adjust the number as needed

        return view('items.index', compact('items', 'search'));
    }
}