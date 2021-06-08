<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSantriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('santri', function (Blueprint $table) {
            $table->integer('nisn')->primary();
            $table->string('nama_santri');
            $table->string('email_santri')->unique();
            $table->string('telepon_santri');
            $table->string('kelas_santri');
            $table->string('perusahaan_santri');
            $table->string('daerah_perusahaan_santri');
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
        Schema::dropIfExists('santri');
    }
}
