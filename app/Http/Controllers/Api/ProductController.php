<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
      $products = Product::get();
      if($products) {
        return ProductResource::collection($products);
      }
      else {
        return response()->json(['success' => false, 'message' => 'No products found'], 200);
      }
    }   


    public function store(Request $request)
    {
        $product=Product::create($request->all());
        return response()->json(['data' =>$product , 'message' => 'Product created successfully'], 201);
    }

    public function show(Product $product)
    {
        return response($product);
    }

    public function update(Request $request, Product $product)
    {
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ]);

        return response()->json(['data' => $product, 'message' => 'Product updated successfully'], 200);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
