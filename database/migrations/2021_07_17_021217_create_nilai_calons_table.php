<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiCalonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_calons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_calon_penerima');
            $table->unsignedBigInteger('C1')->nullable();
            $table->unsignedBigInteger('C2')->nullable();
            $table->unsignedBigInteger('C3')->nullable();
            $table->unsignedBigInteger('C4')->nullable();
        });

        Schema::table('nilai_calons', function (Blueprint $table) {
            $table->foreign('id_calon_penerima')->references('id')->on('calon_penerimas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('C1')->references('id')->on('subkriterias')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('C2')->references('id')->on('subkriterias')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('C3')->references('id')->on('subkriterias')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('C4')->references('id')->on('subkriterias')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_calons');
    }
}
