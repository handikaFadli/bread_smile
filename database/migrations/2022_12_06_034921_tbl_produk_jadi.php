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
        Schema::create('ProdukJadi', function (Blueprint $table) {
            $table->string('kd_produk', 10)->primary();
            $table->string('nm_produk', 50);
            $table->integer('stok');
            $table->double('modal')->nullable();
            $table->double('harga_jual')->nullable();
            $table->double('berat', 10);
            $table->string('ket')->nullable();
            $table->text('foto');

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
        Schema::dropIfExists('ProdukJadi');
    }
};
