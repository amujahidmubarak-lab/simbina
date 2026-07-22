<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('mentorings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('mentee_id')->constrained('users')->cascadeOnDelete();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('status', ['aktif', 'selesai', 'ditangguhkan'])->default('aktif');
            $table->timestamps();
            $table->unique(['mentor_id', 'mentee_id']);
        });
    }
    public function down(): void { Schema::dropIfExists('mentorings'); }
};
