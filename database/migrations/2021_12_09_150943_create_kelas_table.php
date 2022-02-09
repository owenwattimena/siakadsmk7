<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedBigInteger('mapel_kuri_id');
            $table->unsignedBigInteger('guru_id')->nullable();
            $table->unsignedBigInteger('semester_jurusan_id');
            $table->timestamps();

            $table->foreign('mapel_kuri_id')->references('id')->on('matapelajarankurikulum');
            $table->foreign('guru_id')->references('id')->on('guru');
            $table->foreign('semester_jurusan_id')->references('id')->on('semester_jurusan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas');
    }
}
