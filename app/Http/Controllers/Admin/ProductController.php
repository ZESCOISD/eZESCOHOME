<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return ProductService::all();
    }

    public function show($id)
    {
        return ProductService::find($id);
    }

    public function store(Request $request)
    {
        $product = ProductService::create($request->all());
        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $product = ProductService::findOrFail($id);
        $product->update($request->all());
        return response()->json($product, 200);
    }

    public function delete(Request $request, $id)
    {
        $product = ProductService::findOrFail($id);
        $product->delete();

        return response()->json(null, 204);
    }
}
