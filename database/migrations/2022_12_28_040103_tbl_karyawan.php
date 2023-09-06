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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->increments('id_karyawan');
            $table->string('nip', 11);
            $table->string('nm_karyawan', 99);
            $table->integer('kd_jabatan');
            $table->string('jenis_kelamin', 10);
            $table->string('ttl');
            $table->string('status', 99);
            $table->string('no_telp', 15);
            $table->text('alamat');
            $table->string('pendidikan', 99);
            $table->date('tanggal_masuk');
            $table->string('role', 20);
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
        Schema::dropIfExists('karyawan');
    }
};
