<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('broadcasts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->cascadeOnDelete();
            $table->string('judul');
            $table->text('konten');
            $table->enum('target_type', ['semua', 'kontrakan', 'role'])->default('semua');
            $table->unsignedBigInteger('target_id')->nullable(); // kontrakan_id jika per-kontrakan
            $table->boolean('is_penting')->default(false);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('broadcasts'); }
};
