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
        Schema::create('ikk_masters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('matter_id');
            $table->integer('urutan');
            $table->text('ikk_outcome');
            $table->text('definisi_pembilang');
            $table->text('definisi_penyebut');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ikk_masters');
    }
};
