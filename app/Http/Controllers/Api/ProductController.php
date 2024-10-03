<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all index
        $product = Product::latest()->paginate(5);

        //response
        $response = [
            'status' => 'success',
            'message' => 'List all product',
            'data' => $product
        ];

        return response()->json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi data

        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        $validator = Validator::make($request->all(),[
            'categorie_id'=> 'required',
            'product' => 'required|min:2|unique:products',
            'description' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'image' => 'image|mimes:jpeg,jpg,png|max:2048',
        ]);
        //cek jika validasi gagal
        if($validator->fails()) {
            return response()->json([
                'status' => 'faild',
                'message' => 'Invalid filed',
                'errors' => $validator->errors()
            ],422);
        }

        //create product = memasukan data ke database
        $product = Product::create([
            'categorie_id' => $request->categorie_id,
            'product' => $request->product,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $request->image,
        ]);

        //response
        $response = [
            'status'=> 'success',
            'message' => 'Add product succes',
            'data' => $product
        ];

        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //find level by ID
        $product = Product::find($id);

        //response
        $response = [
            'status' => 'success',
            'message' => 'Detail product found',
            'data' => $product
        ];

        return response()-> json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(),[
            'categorie_id'=> 'required',
            'product' => 'required|min:2|unique:products',
            'description' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'image' => 'image|mimes:jpeg,jpg,png|max:2048',
        ]);

        //check if validation fails
        if ($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        //find level by ID
        $product = Product::find($id);

        $product->update([
            'categorie_id' => $request->categorie_id,
            'product' => $request->product,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $request->image,
        ]);

        //response
        $response = [
            'status' => 'success',
            'message' => 'Update product success',
            'data' => $product
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //find product bby ID
        $product = Product::find($id)->delete();

        $response = [
            'status' => 'success',
            'success' => 'Delete product Success'
        ];

        return response()->json($response, 200);
    }
}
