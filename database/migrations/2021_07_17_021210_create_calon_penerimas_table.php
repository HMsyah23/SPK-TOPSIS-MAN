<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalonPenerimasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon_penerimas', function (Blueprint $table) {
            $table->id();
            $table->string('nik',16);
            $table->string('no_ktp',16);
            $table->string('nama_kepala_keluarga',50);
            $table->string('no_hp',14);
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin',1);
            $table->Integer('pendapatan_kepala_keluarga');
            $table->tinyInteger('jumlah_tanggungan');
            $table->string('Pekerjaan',30);
            $table->text('alamat');
            $table->json('berkas');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calon_penerimas');
    }
}
