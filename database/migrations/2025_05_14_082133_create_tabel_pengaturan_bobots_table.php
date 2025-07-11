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
        Schema::create('tabel_pengaturan_bobots', function (Blueprint $table) {
            $table->id();
            $table->string('bobot_harga');
            $table->string('bobot_jarak');
            $table->string('bobot_rating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_pengaturan_bobots');
    }
};
