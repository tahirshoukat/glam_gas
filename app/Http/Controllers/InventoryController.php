<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search', '');

        $query = Inventory::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('location', 'like', '%' . $search . '%')
                ->orWhere('item_description', 'like', '%' . $search . '%');
        }

        $inventories = $query->paginate(10); // Adjust the number as needed

        return view('inventories.index', compact('inventories', 'search'));
    }
}