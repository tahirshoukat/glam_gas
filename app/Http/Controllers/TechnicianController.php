<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Technician;


class TechnicianController extends Controller
{
    public function index(){
        $technicians =  Technician::all();
        return view('technicians.index', compact('technicians'));
    }
}
