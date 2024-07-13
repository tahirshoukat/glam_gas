<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\InventoriesImport;

class InventoryController extends Controller
{
    // public function index(Request $request){
    //     $search = $request->input('search', '');

    //     $query = Inventory::query();

    //     if ($search) {
    //         $query->where('name', 'like', '%' . $search . '%')
    //             ->orWhere('location', 'like', '%' . $search . '%')
    //             ->orWhere('item_description', 'like', '%' . $search . '%');
    //     }

    //     $inventories = $query->paginate(10); // Adjust the number as needed

    //     return view('inventories.index', compact('inventories', 'search'));
    // }
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $inventories = Inventory::where('name', 'like', "%{$search}%")
                                ->orWhere('location', 'like', "%{$search}%")
                                ->paginate(10);

        return view('inventories.index', compact('inventories', 'search'));
    }

    public function uploadCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        Excel::import(new InventoriesImport, $request->file('csv_file'));

        return redirect()->route('inventories')->with('success', 'CSV uploaded successfully.');
    }
}