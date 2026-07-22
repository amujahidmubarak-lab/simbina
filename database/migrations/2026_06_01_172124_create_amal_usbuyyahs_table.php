<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('amal_usbuyyahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('tanggal_awal_pekan');
            $table->boolean('puasa_sunnah')->default(false);
            $table->boolean('baca_alkahfi')->default(false);
            $table->boolean('olahraga')->default(false);
            $table->boolean('bersih_kontrakan')->default(false);
            $table->timestamps();

            // Seorang user hanya bisa punya 1 record untuk 1 pekan tertentu (tanggal_awal_pekan = Senin)
            $table->unique(['user_id', 'tanggal_awal_pekan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('amal_usbuyyahs');
    }
};
