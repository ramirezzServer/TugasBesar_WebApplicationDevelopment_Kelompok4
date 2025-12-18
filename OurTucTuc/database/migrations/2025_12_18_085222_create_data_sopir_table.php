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
        Schema::create('data_sopir', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sopir');
            $table->string('notelp_sopir');
            $table->string('alamat');
            $table->string('email_sopir');
            $table->string('foto');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_sopir');
    }
};
