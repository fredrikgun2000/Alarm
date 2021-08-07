<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlarmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alarm', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor');
            $table->string('email');
            $table->text('isi');
            $table->date('tanggal');
            $table->string('waktu');
            $table->string('status');
            $table->string('pengulangan');
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
        Schema::dropIfExists('alarm');
    }
}
