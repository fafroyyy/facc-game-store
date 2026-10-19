<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('account_submissions', function (Blueprint $table) {
            // Ganti screenshot tunggal dengan screenshots JSON (max 5)
            $table->json('screenshots')->nullable()->after('description');
            // Kolom rekening/e-wallet Customer untuk pencairan dana
            $table->string('bank_type')->nullable()->after('admin_note');
            $table->string('bank_number')->nullable()->after('bank_type');
        });
    }

    public function down(): void
    {
        Schema::table('account_submissions', function (Blueprint $table) {
            $table->dropColumn(['screenshots', 'bank_type', 'bank_number']);
        });
    }
};
