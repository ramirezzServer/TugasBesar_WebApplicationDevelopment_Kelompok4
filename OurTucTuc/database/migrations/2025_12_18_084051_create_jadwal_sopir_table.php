<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal_sopir', function (Blueprint $table) {
            $table->id();
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->enum('status', ['aktif', 'selesai', 'belum_aktif'])
                  ->default('belum_aktif');

            $table->enum('status', ['aktif', 'selesai', 'belum_aktif'])
                    ->default('belum_aktif');

            $table->unsignedBigInteger('id_kendaraan');
            $table->unsignedBigInteger('id_sopir');
            $table->unsignedBigInteger('id_rute_halte');

            $table->foreign('id_kendaraan')
                ->references('id')
                ->on('kendaraan')
                ->onDelete('cascade');

            $table->foreign('id_sopir')
                ->references('id')
                ->on('sopir')
                ->onDelete('cascade');

            $table->foreign('id_rute_halte')
                ->references('id')
                ->on('rute_halte')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_sopir');
    }
};
