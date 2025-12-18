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
        Schema::create('rute_halte', function (Blueprint $table) {
            $table->id();
            $table->time('jam_berangkat');

            $table->unsignedBigInteger('id_halte');
            $table->unsignedBigInteger('id_rute');

            $table->foreign('id_halte')
                ->references('id')
                ->on('halte')
                ->onDelete('cascade');

            $table->foreign('id_rute')
                ->references('id')
                ->on('rute')
                ->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rute_halte');
    }
};
