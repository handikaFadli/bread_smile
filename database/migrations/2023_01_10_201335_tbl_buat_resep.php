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
        Schema::create('BuatResep', function (Blueprint $table) {
            $table->increments('id_buatResep');
            $table->string('kd_resep', 10);
            $table->string('kd_bahan', 10);
            $table->double('jumlah', 10);
            $table->integer('harga_pakai');
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
        Schema::dropIfExists('BuatResep');
    }
};
