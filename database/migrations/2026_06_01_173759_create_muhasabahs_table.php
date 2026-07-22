<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('muhasabahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('tanggal_awal_pekan');
            $table->text('capaian')->nullable();
            $table->text('kendala')->nullable();
            $table->text('target')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'tanggal_awal_pekan']);
        });
    }
    public function down(): void { Schema::dropIfExists('muhasabahs'); }
};
