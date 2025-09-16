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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('penulis');
            $table->integer('induk');
            $table->string('penerbit');
            $table->date('tgl_masuk');
            $table->integer('tahun');
            $table->enum('kategori', ['dongeng', 'cerpen', 'novel', 'komik', 'lainnya'])->default('lainnya');
            $table->integer('jumlah_eksemplar')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
