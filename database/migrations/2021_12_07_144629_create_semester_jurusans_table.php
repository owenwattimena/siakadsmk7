<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemesterJurusansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semester_jurusan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('semester_id');
            $table->date('tanggal_mulai_semester');
            $table->date('tanggal_selesai_semester');
            $table->date('tanggal_mulai_input_nilai');
            $table->date('tanggal_selesai_input_nilai');
            $table->tinyInteger('status_aktif')->default(1);
            $table->unsignedBigInteger('jurusan_id');
            $table->timestamps();

            $table->foreign('semester_id')->references('id')->on('semester');
            $table->foreign('jurusan_id')->references('id')->on('jurusan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('semester_jurusan');
    }
}
