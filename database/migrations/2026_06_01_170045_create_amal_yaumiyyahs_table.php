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
        Schema::create('amal_yaumiyyahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('tanggal');
            $table->integer('tilawah_halaman')->default(0);
            $table->integer('shalat_berjamaah')->default(0);
            $table->boolean('qiyamul_lail')->default(false);
            $table->boolean('puasa_sunnah')->default(false);
            $table->boolean('infaq')->default(false);
            $table->text('catatan')->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'tanggal']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amal_yaumiyyahs');
    }
};
