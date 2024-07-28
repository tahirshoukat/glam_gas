<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Allocation;
use App\Models\Technician;
use App\Models\Inventory;

class AllocationController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search', '');

        $query = Allocation::query();

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->whereHas('technician', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
                $query->orWhereHas('inventory', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('item_description', 'like', '%' . $search . '%');
                });
            });
        }        

        $allocations = $query->with('inventory', 'technician')->paginate(10);

        return view('allocations.index', compact('allocations', 'search'));
    }

    public function create()
    {
        $technicians = Technician::all();
        $inventories = Inventory::all();
        return view('allocations.create', compact('technicians', 'inventories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'technician_id' => 'required|exists:technicians,id',
            'inventory_id' => 'required|exists:inventories,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        $allocation = new Allocation();
        $allocation->technician_id = $request->technician_id;
        $allocation->inventory_id = $request->inventory_id;
        $allocation->quantity = $request->quantity;
        $allocation->commission = $request->quantity * Inventory::find($request->inventory_id)->item_avg_rate * 0.05;
        $allocation->save();

        return redirect()->route('inventories.allocations')->with('success', 'Inventory allocated successfully.');
    }
}
