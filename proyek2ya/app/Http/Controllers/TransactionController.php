<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Tampilkan semua transaksi untuk pengguna
    public function index()
    {
        $transactions = Transaction::where('user_id', auth()->id())->get();
        return view('user.page.transaction.index', compact('transactions'));
    }
    // Menampilkan formulir data transaksi
    public function transactionForm(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        return view('user.page.transaction.redeem', [
            'product' => $product,
            'quantity' => $request->quantity,
        ]);
    }

    // Membuat transaksi baru setelah pengisian data
    public function createTransaction(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'alamat' => 'required|string|max:255',
            'no_tlp' => 'required|string|max:15',
            'ekspedisi' => 'required|string|max:100',
        ]);

        $this->processTransaction($validated);

        return redirect()->route('user.page.transaction.index')->with('success', 'Transaction created successfully!');
    }

    // Fungsi untuk memproses transaksi
    private function processTransaction(array $data)
    {
        $product = Product::findOrFail($data['product_id']);
        $user = auth()->user();

        // Periksa poin pengguna dan stok produk
        $totalPoints = $product->point * $data['quantity'];
        if ($user->points < $totalPoints) {
            abort(400, 'Insufficient points for this transaction.');
        }
        if ($data['quantity'] > ($product->quantity - $product->quantity_out)) {
            abort(400, 'The requested quantity is not available.');
        }

        // Buat transaksi
        Transaction::create([
            'code_transaksi' => 'TRX-' . strtoupper(uniqid()),
            'user_id' => $user->id,
            'product_id' => $product->id,
            'total_qty' => $data['quantity'],
            'total_harga' => $totalPoints,
            'nama_user' => $user->name,
            'alamat' => $data['alamat'],
            'no_tlp' => $data['no_tlp'],
            'ekspedisi' => $data['ekspedisi'],
            'bayar' => 'Point Payment',
            'status' => 'Paid',
        ]);

        // Kurangi poin pengguna
        $user->points -= $totalPoints;
        $user->save();

        // Perbarui stok produk
        $product->quantity_out += $data['quantity'];
        $product->save();
    }
    public function adminIndex()
    {
        $transactions = Transaction::with(['product', 'user'])->paginate(10);

        return view('admin.page.transactions', compact('transactions'));
    }

    // Update status transaksi (admin-only)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Paid,Unpaid',
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->status = $request->status;
        $transaction->save();

        return redirect()->route('admin.page.transactions')->with('success', 'Transaction status updated successfully.');
    }

}
