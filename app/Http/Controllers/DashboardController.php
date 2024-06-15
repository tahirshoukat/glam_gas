<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        // Fetch complaints with associated inventory details
        $complaints = DB::table('complaints')
            ->join('inventories', 'complaints.inventory_id', '=', 'inventories.id')
            ->select('complaints.id as complaint_id', 'complaints.customer_name', 'complaints.created_at', 'inventories.name as inventory_name')
            ->get();

        // Calculate commission per technician per day
        $commissions = DB::table('allocations')
            ->select(DB::raw('technician_id, DATE(allocations.created_at) as date, SUM(allocations.quantity * inventories.item_avg_rate * 0.05) as total_commission'))
            ->join('inventories', 'allocations.inventory_id', '=', 'inventories.id')
            ->groupBy('technician_id', 'date')
            ->get();

        $commissionData = $commissions->groupBy('technician_id')->map(function ($dayData) {
            return $dayData->pluck('total_commission', 'date');
        });

        return view('dashboard', compact('complaints', 'commissionData'));
    }
}