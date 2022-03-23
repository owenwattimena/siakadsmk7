<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatapelajarankurikulumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matapelajarankurikulum', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 60);
            $table->unsignedBigInteger('kurikulum_id');
            $table->tinyInteger('semester');
            $table->double('skm');
            $table->timestamps();

            $table->foreign('kurikulum_id')->references('id')->on('kurikulum');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matapelajarankurikulum');
    }
}
