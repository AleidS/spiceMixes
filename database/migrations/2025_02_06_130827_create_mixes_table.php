<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mixes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('ingredients');
            $table->string('description');
            $table->integer('user_id')->nullable();
            $table->integer('cuisine_id')->default(1);
            $table->timestamps();
        });
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('measure_id');
            $table->integer('quantity');
            $table->boolean('show_alternatives');
            $table->timestamps();
        });
        Schema::create('measures', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('info');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mixes');
    }
};
