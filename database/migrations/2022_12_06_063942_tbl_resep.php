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
        Schema::create('Resep', function (Blueprint $table) {
            $table->string('kd_resep', 10)->primary();
            $table->string('kd_produk', 10);
            $table->double('tot_jumlahPakai', 10);
            $table->double('tot_hargaPakai', 10);
            $table->double('tot_cost', 10);
            $table->double('roti_terbuat', 10);
            $table->double('biaya_tenaga_kerja', 10);
            $table->double('biaya_kemasan', 10);
            $table->double('biaya_peralatan_operasional', 10);
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
        Schema::dropIfExists('Resep');
    }
};
