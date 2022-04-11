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
            $table->float('kinerja1');
            $table->float('kinerja2');
            $table->float('rata_rata_kinerja');
            $table->float('proyek1');
            $table->float('proyek2');
            $table->float('rata_rata_proyek');
            $table->float('portofolio1');
            $table->float('portofolio2');
            $table->float('rata_rata_portofolio');
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
