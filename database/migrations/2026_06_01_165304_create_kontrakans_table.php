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
        Schema::create('kontrakans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kontrakan');
            $table->text('alamat')->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('kapasitas')->default(0);
            $table->foreignId('penanggung_jawab')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontrakans');
    }
};
