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
        Schema::table('rabs', function (Blueprint $table) {
            $table->string('status')->nullable();
            $table->string('verifikasi_sekretaris_at')->timestamp();
            $table->string('verifikasi_sekretaris_by');
            $table->string('verifikasi_bendahara_at')->timestamp();
            $table->string('verifikasi_bendahara_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rabs', function (Blueprint $table) {
            //
        });
    }
};
