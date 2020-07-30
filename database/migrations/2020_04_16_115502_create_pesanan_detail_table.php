<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('produk_id')->unsigned();
            $table->bigInteger('pesanan_id')->unsigned();
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->integer('jml_hari');
            $table->integer('jumlah');
            $table->integer('jumlah_harga');
            $table->timestamps();

            $table->foreign('produk_id')->references('id')->on('produk');
            $table->foreign('pesanan_id')->references('id')->on('pesanan');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan_detail');
    }
}
