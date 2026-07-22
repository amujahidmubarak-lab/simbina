<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('catatan_pembinaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('author_id')->constrained('users')->cascadeOnDelete();
            $table->enum('tipe', ['evaluasi', 'perkembangan', 'khusus'])->default('perkembangan');
            $table->text('konten');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('catatan_pembinaans'); }
};
