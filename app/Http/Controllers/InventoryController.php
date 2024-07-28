<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\InventoriesImport;

class InventoryController extends Controller
{
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

    public function create()
    {
        return view('inventories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'location' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'item_description' => 'required|string|max:255',
            'uom' => 'required|string|max:50',
            'closing_stock' => 'required|numeric',
            'item_avg_rate' => 'required|numeric',
        ]);

        $inventory = new Inventory();
        $inventory->location = $request->location;
        $inventory->name = $request->name;
        $inventory->item_description = $request->item_description;
        $inventory->uom = $request->uom;
        $inventory->closing_stock = $request->closing_stock;
        $inventory->item_avg_rate = $request->item_avg_rate;
        $inventory->total_amount = $request->closing_stock * $request->item_avg_rate;
        $inventory->save();

        return redirect()->route('inventories')->with('success', 'Inventory added successfully.');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt',
        ]);

        $path = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($path));

        foreach ($data as $row) {
            Inventory::create([
                'location' => $row[0],
                'name' => $row[1],
                'item_description' => $row[2],
                'uom' => $row[3],
                'closing_stock' => $row[4],
                'item_avg_rate' => $row[5],
                'total_amount' => $row[4] * $row[5],
            ]);
        }

        return redirect()->route('inventories')->with('success', 'Inventories uploaded successfully.');
    }
}