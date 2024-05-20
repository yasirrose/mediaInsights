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
        Schema::create('my_podcasts', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('itunesId')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('imageUrl')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_podcasts');
    }
};
