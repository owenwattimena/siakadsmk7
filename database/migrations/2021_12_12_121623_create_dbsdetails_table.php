<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDbsdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dbs_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dbs_id');
            $table->float('bobot_nilai')->nullable();
            $table->char('predikat')->nullable();
            $table->unsignedBigInteger('kelas_id');
            $table->timestamps();

            $table->foreign('dbs_id')->references('id')->on('dbs');
            $table->foreign('kelas_id')->references('id')->on('kelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dbs_detail');
    }
}
