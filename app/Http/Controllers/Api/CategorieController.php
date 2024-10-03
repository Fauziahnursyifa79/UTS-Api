<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Support\Facades\Validator;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all index
        $categorie = Categorie::latest()->paginate(5);

        //response
        $response = [
            'status' => 'success',
            'message' => 'List all Categorie',
            'data' => $categorie
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
        //Validasi Data
        $validator = Validator::make($request->all(),[
            'categorie' => 'required|unique:categories|min:2',
        ]);

        //cek jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'Faild',
                'message' => 'Invalid field',
                'errors' => $validator->errors()
            ],422);
        }

        //create categorie = memasukan data kedatabase
        $categorie = Categorie::create([
            'categorie' => $request->categorie,
        ]);

        //response
        $response = [
            'status' => 'success',
            'message' => 'Add Categorie success',
            'data' => $categorie,
        ];
        return response()-> json($response, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //find categorie by ID
        $categorie = Categorie::find($id);

        //response
        $response = [
            'status' => 'success',
            'message' => 'Detail Categorie found',
            'data' => $categorie,
        ];

        return response()->json($response, 200);
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
            'categorie' => 'required|unique:categories|min:2',
        ]);

        //check if validation fails
        if ($validator->fails()){
            return response()->json($validator->errors(),422);
        }

        //find level by ID
        $categorie = Categorie::find($id);

        $categorie->update ([
            'categorie' => $request->categorie,
        ]);


        //response
        $response = [
            'status' => 'success',
            'message' => 'Update Categorie Success',
            'data' => $categorie,
        ];

        return response()->json($response, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //find categorie by ID
        $categories = Categorie::find($id)->delete();

        $response = [
            'status' => 'success',
            'message' => 'Delete categorie Success',
        ];
        return response()->json($response, 201);
    }
}
