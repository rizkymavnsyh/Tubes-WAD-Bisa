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
        'nama', // Changed from 'nama_produk' to 'nama'
        'kategori_id',
        'harga',
        'stok',
        'deskripsi',
        'gambar' // Added 'gambar'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}