<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('mentoring_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentoring_id')->constrained()->cascadeOnDelete();
            $table->foreignId('author_id')->constrained('users')->cascadeOnDelete();
            $table->text('catatan');
            $table->date('tanggal');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('mentoring_notes'); }
};
