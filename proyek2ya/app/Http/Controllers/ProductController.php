<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Admin: Menampilkan halaman market dengan produk dan transaksi
    public function index()
    {
        $products = Product::paginate(4); // Produk dengan pagination
        $transactions = Transaction::with(['product', 'user'])->paginate(10); // Transaksi dengan relasi
        return view('admin.page.market', compact('products', 'transactions'));
    }

    // Admin: Menampilkan halaman untuk menambah produk
    public function create()
    {
        return view('admin.page.items.create');
    }

    // Admin: Menyimpan produk baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_product' => 'required|string|max:255',
            'point' => 'required|numeric',
            'description' => 'nullable|string',
            'quantity' => 'required|numeric|min:1',
            'quantity_out' => 'nullable|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $validated['kode_barang'] = 'PRD-' . strtoupper(substr($validated['nama_product'], 0, 3)) . '-' . time();
        $validated['user_id'] = auth()->id(); // Set user_id ke admin yang login

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.page.market')->with('success', 'Product created successfully.');
    }

    // Admin: Menampilkan halaman edit produk
    public function edit(Product $product)
    {
        return view('admin.page.items.edit', compact('product'));
    }

    // Admin: Memperbarui produk
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'nama_product' => 'required|string|max:255',
            'point' => 'required|numeric',
            'description' => 'nullable|string',
            'quantity' => 'required|numeric|min:1',
            'quantity_out' => 'nullable|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($product->foto) {
                Storage::delete('public/' . $product->foto);
            }
            $validated['foto'] = $request->file('foto')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.page.market')->with('success', 'Product updated successfully.');
    }

    // Admin: Menghapus produk
    public function destroy(Product $product)
    {
        if ($product->foto) {
            Storage::delete('public/' . $product->foto);
        }
        $product->delete();

        return redirect()->route('admin.page.market')->with('success', 'Product deleted successfully.');
    }

    // User: Menampilkan halaman market dengan daftar produk dan transaksi pengguna
    public function userMarket()
    {
        $products = Product::paginate(4); // Produk dengan pagination
        $transactions = Transaction::with(['product'])->where('user_id', auth()->id())->get(); // Transaksi berdasarkan pengguna

        return view('user.page.market', compact('products', 'transactions'));
    }

    // User: Menangani proses redeem produk
    // public function redeem(Request $request)
    // {
    //     $validated = $request->validate([
    //         'product_id' => 'required|exists:products,id',
    //         'kode_barang' => 'required|string',
    //         'quantity' => 'required|numeric|min:1',
    //     ]);

    //     $product = Product::findOrFail($validated['product_id']);

    //     // Memeriksa ketersediaan quantity
    //     if ($validated['quantity'] > ($product->quantity - $product->quantity_out)) {
    //         return back()->withErrors(['quantity' => 'The requested quantity is not available.']);
    //     }

    //     // Menghitung total poin
    //     $totalPoints = $product->point * $validated['quantity'];

    //     // Membuat transaksi baru
    //     Transaction::create([
    //         'user_id' => auth()->id(),
    //         'product_id' => $product->id,
    //         'kode_barang' => $validated['kode_barang'],
    //         'quantity' => $validated['quantity'],
    //         'total_point' => $totalPoints,
    //         'status' => 'pending',
    //     ]);

    //     // Memperbarui quantity_out produk
    //     $product->quantity_out += $validated['quantity'];
    //     $product->save();

    //     return redirect()->route('user.page.market')->with('success', 'Product redeemed successfully!');
    // }
}
