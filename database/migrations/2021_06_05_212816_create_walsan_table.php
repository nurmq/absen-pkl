<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalsanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('walsan', function (Blueprint $table) {
            $table->id();
            $table->foreignId("santri_nisn");
            $table->string('nama_walsan');
            $table->string('email_walsan');
            $table->string('telepon_walsan');
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
        Schema::dropIfExists('walsan');
    }
}
