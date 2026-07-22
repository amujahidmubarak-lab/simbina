<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('kas_kontrakans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kontrakan_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // recorded_by
            $table->enum('tipe', ['masuk', 'keluar']);
            $table->unsignedBigInteger('jumlah');
            $table->string('keterangan');
            $table->date('tanggal');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('kas_kontrakans'); }
};
