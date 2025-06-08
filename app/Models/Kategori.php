<?php
// Buat model baru: php artisan make:model Kategori

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';
    protected $fillable = ['nama'];

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }
}
