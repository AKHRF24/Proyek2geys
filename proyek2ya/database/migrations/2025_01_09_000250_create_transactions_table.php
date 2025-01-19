<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // ID Transaksi
            $table->string('code_transaksi')->unique(); // Kode Transaksi Unik
            $table->unsignedBigInteger('user_id'); // ID Pengguna
            $table->unsignedBigInteger('product_id'); // ID Produk
            $table->integer('total_qty'); // Total Kuantitas Produk
            $table->integer('total_harga'); // Total Harga (dalam poin)
            $table->string('nama_user'); // Nama Pengguna
            $table->string('alamat'); // Alamat Pengguna
            $table->string('no_tlp'); // Nomor Telepon Pengguna
            $table->enum('status', ['Unpaid', 'Paid'])->default('Unpaid'); // Status Transaksi
            $table->string('ekspedisi')->nullable(); // Nama Ekspedisi (Opsional)
            $table->string('bayar')->nullable(); // Informasi Metode Pembayaran
            $table->timestamps(); // Timestamps (created_at, updated_at)

            // Relasi ke tabel users dan products
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
