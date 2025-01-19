@extends('user.layouts.index')

@section('content')
<div class="container">
    <h2>Detail Transaksi</h2>

    <table class="table table-bordered">
        <tr>
            <th>Kode Transaksi</th>
            <td>{{ $transaction->code_transaksi }}</td>
        </tr>
        <tr>
            <th>Total Kuantitas</th>
            <td>{{ $transaction->total_qty }}</td>
        </tr>
        <tr>
            <th>Total Harga</th>
            <td>{{ number_format($transaction->total_harga, 2) }}</td>
        </tr>
        <tr>
            <th>Nama User</th>
            <td>{{ $transaction->nama_user }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $transaction->alamat }}</td>
        </tr>
        <tr>
            <th>No Telepon</th>
            <td>{{ $transaction->no_tlp }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $transaction->status }}</td>
        </tr>
        <tr>
            <th>Waktu Transaksi</th>
            <td>{{ $transaction->created_at->format('d M Y H:i:s') }}</td>
        </tr>
    </table>
</div>
@endsection
