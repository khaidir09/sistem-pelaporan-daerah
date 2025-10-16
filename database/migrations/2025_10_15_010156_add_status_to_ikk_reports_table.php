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
        Schema::table('ikk_reports', function (Blueprint $table) {
            $table->enum('status', ['Dikirim', 'Revisi', 'Dikirim Ulang', 'Disetujui'])->default('Dikirim')->after('reviu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ikk_reports', function (Blueprint $table) {
            //
        });
    }
};
