<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Items extends Model
{
    use HasFactory;

    // Nama tabel yang terhubung
    protected $table = 'items';

    // Menyertakan timestamps
    public $timestamps = true;

    // Field yang dapat diisi secara massal
    protected $fillable = [
        'nama_items',
        'point',
        'quantity',
        'foto',
        'description'
    ];

    /**
     * Fungsi untuk mengambil daftar item dengan raw SQL.
     * Ini digunakan jika Anda memerlukan query khusus.
     */
    public static function getListItems()
    {
        $sql = "SELECT * FROM items";
        return DB::connection()->select($sql);
    }

    /**
     * Scope untuk memfilter items berdasarkan poin tertentu (opsional).
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $points
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterByPoints($query, $points)
    {
        return $query->where('point', '<=', $points);
    }
}
