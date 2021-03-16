<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
 

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nik')->unsigned();
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jabatan')->nullable();
            $table->string('departemen')->nullable();
            $table->string('alamat')->nullable();
            $table->string('telepon')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('level', ['hrd', 'pegawai'])->default('pegawai')->comment('level admin');
            $table->string('foto')->default('user.png');

            $table->double('gaji_pokok')->default(0);
            $table->integer('bpjs_kesehatan')->default(1);
            $table->integer('bpjs_jht')->default(1);
            $table->double('uang_makan')->default('15000');
            $table->double('uang_transport')->default(0);

            $table->rememberToken();
            $table->timestamps();
        });
        // DB::unprepared('ALTER TABLE pegawai CHANGE nik nik INT(4) UNSIGNED ZEROFILL NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
}
