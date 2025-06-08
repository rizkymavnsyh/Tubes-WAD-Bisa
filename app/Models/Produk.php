<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    
    // Perbarui fillable untuk menyertakan kolom baru
    protected $fillable = ['nama', 'kategori_id', 'harga', 'stok', 'deskripsi', 'gambar'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
