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
        Schema::create('bahanMasuk', function (Blueprint $table) {
            // untuk bahan masuk
            $table->increments('id_bahanMasuk');
            $table->string('kd_bahan', 10);
            $table->string('nm_bahan', 50);
            $table->date('tgl_masuk');
            $table->double('jumlah', 10);
            $table->string('ket')->nullable();
            $table->double('total');
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
        Schema::dropIfExists('bahanMasuk');
    }
};
