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
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->string('email')->unique()->after('prodi_id');
            $table->string('password')->after('email');
            $table->string('otp')->nullable()->after('password');
            $table->boolean('is_verified')->default(false)->after('otp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('password');
            $table->dropColumn('otp');
            $table->dropColumn('is_verified');
        });
    }
};
