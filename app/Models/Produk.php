<?php
// app/Models/Produk.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';
    
    protected $fillable = [
        'nama_produk',
        'kategori_id',
        'harga',
        'stok',
        'deskripsi'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
