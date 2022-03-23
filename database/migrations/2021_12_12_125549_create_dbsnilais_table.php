<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDbsnilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dbs_nilai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dbs_detail_id');
            $table->float('kd1');
            $table->float('kd2');
            $table->float('kd3');
            $table->float('kd4');
            $table->float('kd5');
            $table->float('kd6');
            $table->float('kd7');
            $table->float('kd8');
            $table->float('kd9');
            $table->float('kd10');
            $table->float('rata_rata_kd');
            $table->float('pts');
            $table->float('pas');
            $table->float('n_raport_pengetahuan');
            $table->string('predikat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dbs_nilai');
    }
}
