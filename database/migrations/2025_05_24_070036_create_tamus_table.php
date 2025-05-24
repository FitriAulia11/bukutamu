<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('tamus', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('telepon');
        $table->timestamp('tanggal_datang')->useCurrent(); // otomatis waktu input
        $table->text('alamat');
        $table->string('keperluan');
        $table->string('kategori');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tamus');
    }
};
