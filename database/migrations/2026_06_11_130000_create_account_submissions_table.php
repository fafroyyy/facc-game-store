<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('account_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('seller_name');
            $table->string('seller_email');
            $table->string('whatsapp');
            $table->string('game_category');
            $table->decimal('price', 12, 2);
            $table->string('login_method');
            $table->longText('description');
            $table->string('screenshot')->nullable();
            $table->string('status')->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('payment_number')->nullable();
            $table->text('admin_note')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('account_submissions');
    }
};
