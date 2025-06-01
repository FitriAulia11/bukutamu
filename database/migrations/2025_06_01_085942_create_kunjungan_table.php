<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKunjunganTable extends Migration
{
    public function up()
    {
        Schema::create('kunjungan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tamu_id');
            $table->timestamp('tanggal_kunjungan')->nullable();
            $table->timestamps();

            $table->foreign('tamu_id')->references('id')->on('tamus')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kunjungan');
    }
}
