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
        Schema::create('pinjam_bukus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_buku')->constrained('bukus')->onDelete('cascade');
            $table->foreignId('id_peminjam')->constrained('users', 'id_user')->onDelete('cascade');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjam_bukus');
    }
};
