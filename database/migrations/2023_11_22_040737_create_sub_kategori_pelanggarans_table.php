<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubKategoriPelanggaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_kategori_pelanggarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategoriPelanggaran_id');
            $table->string('namaSubKategoriPelanggaran');
            $table->string('slug');
            $table->string('uuid');
            $table->boolean('isActive');
            $table->timestamps();
            $table->foreign('kategoriPelanggaran_id')->references('id')->on('kategori_pelanggarans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_kategori_pelanggarans');
    }
}
