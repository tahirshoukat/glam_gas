<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Allocation;

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
}
