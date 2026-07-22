<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->date('alumni_date')->nullable()->after('status');
            $table->timestamp('last_login_at')->nullable()->after('alumni_date');
        });
    }
    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['alumni_date', 'last_login_at']);
        });
    }
};
