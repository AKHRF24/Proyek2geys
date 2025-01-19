<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('point');
            $table->string('description')->nullable();
            $table->string('kode_barang')->unique();
            $table->string('nama_product');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('quantity_out')->default(0);
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // Tidak ada klausa AFTER
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
