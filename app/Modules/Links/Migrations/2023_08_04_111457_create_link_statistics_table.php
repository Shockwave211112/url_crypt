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
        Schema::create('link_statistics', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->foreignId('link_id')->references('id')->on('links')->onDelete('cascade');
            $table->integer('hits');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('link_statistics');
    }
};
