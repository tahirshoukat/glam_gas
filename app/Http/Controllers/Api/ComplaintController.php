<?php

// app/Http/Controllers/Api/ComplaintController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Http\Response;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the complaints.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complaints = Complaint::all();
        return response()->json($complaints, Response::HTTP_OK);
    }

    /**
     * Store a newly created complaint in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'contact1' => 'required|string|max:255',
            'contact2' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'product_category' => 'required|string|max:255',
            'barcode' => 'required|string|max:255',
            'complaint_details' => 'required|string',
            'status' => 'required|in:active,closed,unresolved,in_progress',
        ]);

        $complaint = Complaint::create($validatedData);
        // return response()->json(Response::HTTP_CREATED);
        return response()->json([
            'message' => 'complaint created successfully',
            'status' => Response::HTTP_CREATED
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified complaint.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $complaint = Complaint::findOrFail($id);
        return response()->json($complaint, Response::HTTP_OK);
    }

    /**
     * Update the specified complaint in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'customer_name' => 'sometimes|required|string|max:255',
            'contact1' => 'sometimes|required|string|max:255',
            'contact2' => 'nullable|string|max:255',
            'address' => 'sometimes|required|string|max:255',
            'product_category' => 'sometimes|required|string|max:255',
            'barcode' => 'sometimes|required|string|max:255',
            'complaint_details' => 'sometimes|required|string',
            'status' => 'sometimes|required|in:active,closed,unresolved,in_progress',
        ]);

        $complaint = Complaint::findOrFail($id);
        $complaint->update($validatedData);

        return response()->json($complaint, Response::HTTP_OK);
    }

    /**
     * Remove the specified complaint from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}