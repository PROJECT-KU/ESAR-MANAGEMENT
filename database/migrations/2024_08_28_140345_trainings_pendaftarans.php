<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TrainingsPendaftarans extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('trainings_pendaftarans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('trainings_id')->nullable();
            $table->string('id_transaksi')->nullable();
            $table->string('name')->nullable();
            $table->string('telp')->nullable();
            $table->string('email')->nullable();
            $table->string('biaya')->nullable();
            $table->string('kode_unik_biaya')->nullable();
            $table->string('biaya_diskon')->nullable();
            $table->string('total_biaya')->nullable();
            $table->string('metode_pembayaran')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('status')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('trainings_id')->references('id')->on('trainings')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trainings_pendaftarans', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['trainings_id']);
        });

        Schema::dropIfExists('trainings_pendaftarans');
    }
};
