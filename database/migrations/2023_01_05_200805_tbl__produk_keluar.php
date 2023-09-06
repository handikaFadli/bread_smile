<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ProdukKeluar', function (Blueprint $table) {
            $table->increments('id_produkKeluar');
            $table->string('kd_produk', 10);
            $table->string('nip_karyawan');
            $table->integer('jumlah');
            $table->date('tgl_keluar');
            $table->integer('harga_jual');
            $table->double('total');
            $table->string('ket')->nullable();
            $table->integer('stts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.`
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ProdukKeluar');
    }
};
