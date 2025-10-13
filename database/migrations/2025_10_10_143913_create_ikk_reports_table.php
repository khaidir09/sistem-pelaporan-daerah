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
        Schema::create('ikk_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ikk_master_id');
            $table->unsignedBigInteger('user_id');
            $table->longText('ikk_output');
            $table->integer('year');
            $table->decimal('nilai_pembilang', 20, 3);
            $table->decimal('nilai_penyebut', 20, 3);
            $table->decimal('capaian', 20, 7);
            $table->string('file', 255)->nullable();
            $table->text('reviu')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('file_evaluasi', 255)->nullable();
            $table->decimal('capaian_evaluasi', 20, 7);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ikk_reports');
    }
};
