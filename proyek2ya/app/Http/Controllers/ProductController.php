<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return view('admin.page.market', compact('product'));
    }

    public function create()
    {
        return view('admin.page.items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'point' => 'required|numeric',
            'description' => 'required',
        ]);

        Product::create($request->only(['name', 'point','description']));

        return redirect()->route('admin.page.market')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('admin.page.items.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'point' => 'required|numeric',
            'description' => 'required',
        ]);

        $product->update($request->only(['name', 'point','description']));

        return redirect()->route('admin.page.market')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.page.market')->with('success', 'Product deleted successfully.');
    }
}
