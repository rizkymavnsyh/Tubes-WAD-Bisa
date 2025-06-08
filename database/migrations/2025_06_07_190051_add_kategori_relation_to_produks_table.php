<?php
// Buat file migrasi baru: php artisan make:migration add_kategori_relation_to_produks_table

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            // Hapus kolom kategori lama jika ada
            if (Schema::hasColumn('produks', 'kategori')) {
                $table->dropColumn('kategori');
            }

            // Tambahkan kolom baru
            $table->foreignId('kategori_id')->nullable()->constrained('kategoris')->onDelete('set null');
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropColumn(['kategori_id', 'deskripsi', 'gambar']);
            $table->string('kategori')->nullable(); // Kembalikan kolom lama jika rollback
        });
    }
};
