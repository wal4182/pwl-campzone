<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_produk');
            $table->bigInteger('kategori_id')->unsigned();
            $table->bigInteger('brand_id')->unsigned();
            $table->integer('harga_sewa');
            $table->integer('stok');
            $table->string('deskripsi');
            $table->string('spesifikasi');
            $table->string('foto')->nullable();
            $table->timestamps();
            
            // foreign
            $table->foreign('kategori_id')->references('id')->on('kategori');
            $table->foreign('brand_id')->references('id')->on('brand');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk');
    }
}
