<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Karena kita ubah logika stok ke status
            $table->string('status')->default('available')->after('price'); // available, sold
            $table->json('images')->nullable()->after('status');
        });

        // Set status 'sold' untuk produk yang stoknya 0, lalu hapus kolom stock
        // Update menggunakan facade DB untuk memastikan tidak error di driver tertentu
        \Illuminate\Support\Facades\DB::table('products')->where('stock', '<', 1)->update(['status' => 'sold']);

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('stock');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('stock')->default(1)->after('image');
        });

        \Illuminate\Support\Facades\DB::table('products')->where('status', 'sold')->update(['stock' => 0]);

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['status', 'images']);
        });
    }
};
