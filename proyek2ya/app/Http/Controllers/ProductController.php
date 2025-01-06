<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.page.market', compact('products'));
    }

    public function create()
    {
        return view('admin.page.items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'point' => 'required|numeric',
            'description' => 'required|string',
        ]);

        Product::create($validated);

        return redirect()->route('admin.page.market')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('admin.page.items.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'point' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $product->update($validated);

        return redirect()->route('admin.page.market')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.page.market')->with('success', 'Product deleted successfully.');
    }

    public function userMarket()
    {
        $products = Product::all();
        return view('user.page.market', compact('products'));
    }
}
