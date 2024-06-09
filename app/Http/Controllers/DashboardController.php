<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Allocation;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        // Calculate commission per technician per day
        $commissions = DB::table('allocations')
        ->select(DB::raw('technician_id, DATE(allocations.created_at) as date, SUM(allocations.quantity * inventories.item_avg_rate * 0.05) as total_commission'))
        ->join('inventories', 'allocations.inventory_id', '=', 'inventories.id')
        ->groupBy('technician_id', 'date')
        ->get();

        $commissionData = $commissions->groupBy('technician_id')->map(function ($dayData) {
        return $dayData->pluck('total_commission', 'date');
        });

        return view('dashboard', compact('commissionData'));
    }
}
