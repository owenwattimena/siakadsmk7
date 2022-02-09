<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSemesterAndSkmColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matapelajarankurikulum', function (Blueprint $table) {
            $table->tinyInteger('semester');
            $table->double('skm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matapelajarankurikulum', function (Blueprint $table) {
            $table->dropColumn('semester');
            $table->dropColumn('skm');
        });
    }
}
