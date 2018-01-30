<?php

namespace App\Http\Controllers;
use App\Products;
use App\Http\Controllers\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        
        return Products::all();
    }
 
    public function show(Products $product)
    {
        return $product;
    }

    public function store(Request $request)
    {
        $product = Products::create($request->all());
        
        return response()->json($product, 201);
    }

    public function update(Request $request, Products $product)
    {
        $product->update($request->all());

        return response()->json($product, 200);
        
    }

    public function delete(Products $product)
    {
        $product->delete();

        return response()->json(null, 204);
    }

}
