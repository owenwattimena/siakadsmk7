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
            $table->float('nilai_pengetahuan');
            $table->float('nilai_ketrampilan');
            $table->float('nilai_akhir');
            $table->float('kehadiran');
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
        Schema::dropIfExists('dbs_nilai');
    }
}
