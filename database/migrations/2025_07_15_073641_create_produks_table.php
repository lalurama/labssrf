<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jenis');
            $table->text('deskripsi')->nullable();
            $table->decimal('hargajual', 10, 2); // Assuming harga is a decimal with 8 digits total and 2 decimal places
            $table->decimal('hargabeli', 10, 2); // Assuming harga is a decimal with 8 digits total and 2 decimal places
            $table->string('foto')->nullable(); // Assuming foto is a string, can be a file path or URL
            $table->integer('stock')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
