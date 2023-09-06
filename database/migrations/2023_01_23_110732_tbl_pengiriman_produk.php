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
        Schema::create('PengirimanProduk', function (Blueprint $table) {
            $table->increments('id_pengirimanProduk');
            $table->string('kd_produk', 10);
            $table->integer('id_produkKeluar');
            $table->string('kd_sopir', 10);
            $table->string('kd_mobil', 10);
            $table->integer('id_lokasi');
            $table->integer('status');
            // agar boleh null
            $table->text('bukti_foto')->nullable();
            $table->string('nm_penerima', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PengirimanProduk');
    }
};
