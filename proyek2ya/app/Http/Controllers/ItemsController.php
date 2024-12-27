<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan semua data dari tabel items.
     */
    public function index()
    {
        $items = Items::all();
        return response()->json($items); // Mengembalikan data dalam bentuk JSON
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan form untuk menambahkan data baru.
     */
    public function create()
    {
        return view('items.create'); // Asumsi Anda memiliki file `resources/views/items/create.blade.php`
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan data baru ke tabel items.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_items' => 'required|string|max:255',
            'description' => 'nullable|string',
            'point' => 'required|integer',
            'quantity' => 'required|integer',
            'foto' => 'nullable|string|max:255',
        ]);

        $item = new Items();
        $item->nama_items = $request->nama_items;
        $item->description = $request->description;
        $item->point = $request->point;
        $item->quantity = $request->quantity;
        $item->foto = $request->foto;
        $item->save();

        return response()->json(['message' => 'Item berhasil ditambahkan', 'data' => $item], 201);
    }

    /**
     * Display the specified resource.
     * Menampilkan detail data berdasarkan ID.
     */
    public function show(string $id)
    {
        $item = Items::find($id);

        if (!$item) {
            return response()->json(['message' => 'Item tidak ditemukan'], 404);
        }

        return response()->json($item);
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan form untuk mengedit data.
     */
    public function edit(string $id)
    {
        $item = Items::find($id);

        if (!$item) {
            return redirect()->route('items.index')->with('error', 'Item tidak ditemukan');
        }

        return view('items.edit', compact('item')); // Asumsi file `resources/views/items/edit.blade.php` tersedia
    }

    /**
     * Update the specified resource in storage.
     * Memperbarui data berdasarkan ID.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_items' => 'required|string|max:255',
            'description' => 'nullable|string',
            'point' => 'required|integer',
            'quantity' => 'required|integer',
            'foto' => 'nullable|string|max:255',
        ]);

        $item = Items::find($id);

        if (!$item) {
            return response()->json(['message' => 'Item tidak ditemukan'], 404);
        }

        $item->nama_items = $request->nama_items;
        $item->description = $request->description;
        $item->point = $request->point;
        $item->quantity = $request->quantity;
        $item->foto = $request->foto;
        $item->save();

        return response()->json(['message' => 'Item berhasil diperbarui', 'data' => $item], 200);
    }

    /**
     * Remove the specified resource from storage.
     * Menghapus data berdasarkan ID.
     */
    public function destroy(string $id)
    {
        $item = Items::find($id);

        if (!$item) {
            return response()->json(['message' => 'Item tidak ditemukan'], 404);
        }

        $item->delete();

        return response()->json(['message' => 'Item berhasil dihapus'], 200);
    }

    /**
     * Menampilkan semua items di halaman marketplace.
     * Bisa digunakan untuk frontend.
     */
    public function items()
    {
        $items = Items::all();
        return view('marketplace', compact('items')); // Asumsi file `resources/views/marketplace.blade.php` tersedia
    }
}
