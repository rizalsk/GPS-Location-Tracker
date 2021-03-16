<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGajisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaji', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pegawai');
            $table->integer('bulan');
            $table->integer('tahun');

            $table->integer('hari_kerja')->default(0);
            $table->integer('hari_izin')->default(0);
            $table->integer('hari_sakit')->default(0);
            $table->integer('hari_cuti')->default(0);

            $table->double('gaji_pokok')->default(0);
            $table->double('bpjs_kesehatan')->default(0);
            $table->double('bpjs_tk')->default(0);
            $table->double('bpjs_jht')->default(0);
            $table->double('potongan')->default(0);
            $table->double('total')->default(0);
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
        Schema::dropIfExists('gaji');
    }
}
