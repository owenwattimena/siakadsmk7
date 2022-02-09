<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dbs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('semester_jurusan_id');
            $table->bigInteger('siswa_nis');
            $table->timestamps();

            $table->foreign('semester_jurusan_id')->references('id')->on('semester_jurusan');
            $table->foreign('siswa_nis')->references('nis')->on('siswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dbs');
    }
}
