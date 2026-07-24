<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display all products.
     */
    public function index()
    {
        return response()->json([
            'data' => Product::all()
        ]);
    }


    /**
     * Store a new product.
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        return response()->json([
            'message' => 'Product created successfully',
            'data' => $product,
        ], 201);
    }


    /**
     * Display one product.
     */
    public function show(Product $product)
    {
        return response()->json([
            'data' => $product
        ]);
    }


    /**
     * Update product.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return response()->json([
            'message' => 'Product updated successfully',
            'data' => $product,
        ]);
    }


    /**
     * Enable product.
     */
    public function enable(Product $product)
    {
        $product->update([
            'status' => true
        ]);

        return response()->json([
            'message' => 'Product enabled'
        ]);
    }


    /**
     * Disable product.
     */
    public function disable(Product $product)
    {
        $product->update([
            'status' => false
        ]);

        return response()->json([
            'message' => 'Product disabled'
        ]);
    }


    /**
     * Remove product. (Part of the CRUD but not will show in the Products Table dashboard)
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'Product deleted'
        ]);
    }
}