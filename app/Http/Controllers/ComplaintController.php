<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;

class ComplaintController extends Controller
{
    public function index(){
        $complaints =  Complaint::all();
        return view('complaints.index', compact('complaints'));
    }
}
