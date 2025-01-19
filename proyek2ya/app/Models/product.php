<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'nama_product',
        'point',
        'description',
        'quantity',
        'quantity_out',
        'foto',
        'kode_barang',
        'user_id',
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function getFormattedPointAttribute()
    {
        return number_format($this->point, 0, ',', '.');
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
