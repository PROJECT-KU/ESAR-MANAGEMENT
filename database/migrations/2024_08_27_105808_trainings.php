<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Trainings extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->dateTime('tanggal_mulai')->nullable();
            $table->dateTime('tanggal_akhir')->nullable();
            $table->string('biaya')->nullable();
            $table->string('name_diskon')->nullable();
            $table->string('biaya_diskon')->nullable();
            $table->string('lokasi')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('status')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
