<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nis')->unique(); #Nomor Induk Siswa as Unique Key
            $table->string('nama', 60);          #Nama Siswa
            $table->string('jurusan_kode');      #Kode Jurusan
            $table->integer('angkatan');         #Tahun angkatan
            $table->timestamps();

            $table->foreign('jurusan_kode')->references('kode')->on('jurusan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
