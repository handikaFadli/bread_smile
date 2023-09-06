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
        Schema::create('bahanKeluar', function (Blueprint $table) {
            $table->increments('id_bahanKeluar');
            $table->string('kd_bahan', 10);
            $table->string('nm_bahan', 50);
            $table->date('tgl_keluar');
            $table->double('jumlah', 10);
            $table->double('total');
            $table->string('ket')->nullable();
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
        Schema::dropIfExists('bahanKeluar');
    }
};
