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
        Schema::table('matters', function (Blueprint $table) {
            $table->enum('category', ['Urusan Pemerintahan Wajib Berkaitan Pelayanan Dasar', 'Urusan Pemerintahan Wajib Tidak Berkaitan Pelayanan Dasar', 'Pilihan'])->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('matters', function (Blueprint $table) {
            //
        });
    }
};
