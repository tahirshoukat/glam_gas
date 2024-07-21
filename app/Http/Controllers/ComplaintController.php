<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\Technician;

class ComplaintController extends Controller
{
    // public function index(){
    //     $complaints =  Complaint::all();
    //     return view('complaints.index', compact('complaints'));
    // }

    // public function details($id)
    // {
    //     $complaint = Complaint::findOrFail($id);
    //     return view('complaints.view', compact('complaint'));
    // }
    public function index()
    {
        $complaints = Complaint::all();
        return view('complaints.index', compact('complaints'));
    }

    public function create()
    {
        return view('complaints.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'contact1' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'problem' => 'required|string',
            'warranty_status' => 'required|file|mimes:jpeg,png,jpg,gif,svg',
            'purchased_from' => 'required|string|max:255',
            'cancel_reason' => 'nullable|string|max:255',
            'model_photo' => 'required|file|mimes:jpeg,png,jpg,gif,svg,mp4,mov,avi',
            'product' => 'required|string|max:255',
        ]);

        // Generate a unique complaint number
        $complaintNumber = 'A-' . str_pad(Complaint::max('id') + 1, 2, '0', STR_PAD_LEFT);

        // Handle file uploads
        $warrantyStatusPath = $request->file('warranty_status')->store('warranty_status');
        $modelPhotoPath = $request->file('model_photo')->store('model_photos');

        // Store the complaint
        Complaint::create([
            'customer_name' => $request->customer_name,
            'contact1' => $request->contact1,
            'address' => $request->address,
            'problem' => $request->problem,
            'warranty_status' => $warrantyStatusPath,
            'purchased_from' => $request->purchased_from,
            'cancel_reason' => $request->cancel_reason,
            'model_photo' => $modelPhotoPath,
            'product' => $request->product,
            'complaint_number' => $complaintNumber,
            'status' => 'Pending', // or any default status
        ]);

        return redirect()->route('complaints.index')->with('success', 'Complaint registered successfully!');
    }

    public function show(Complaint $complaint)
    {
        $technicians = Technician::all(); // Adjust as needed
        return view('complaints.show', compact('complaint', 'technicians'));
    }

    public function assignTechnician(Request $request, Complaint $complaint)
    {
        $request->validate([
            'technician_id' => 'required|exists:technicians,id',
        ]);

        $complaint->update(['technician_id' => $request->technician_id]);

        return redirect()->route('complaints.view', $complaint->id)->with('success', 'Technician assigned successfully!');
    }
}
