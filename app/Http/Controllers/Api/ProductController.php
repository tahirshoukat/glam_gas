<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
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
            'product_details' => 'required|string',
            'status' => 'required|in:active,closed,unresolved,in_progress',
        ]);

        $products = Product::create($validatedData);
        // return response()->json(Response::HTTP_CREATED);
        return response()->json([
            'message' => 'product created successfully',
            'status' => Response::HTTP_CREATED
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
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
            'product_details' => 'sometimes|required|string',
            'status' => 'sometimes|required|in:active,closed,unresolved,in_progress',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validatedData);

        return response()->json($product, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
