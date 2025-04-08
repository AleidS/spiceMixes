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
            $table->string('description')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('cuisine_id')->default(1);
            $table->string('source_url')->nullable();
            $table->string('source_name')->nullable();
            $table->boolean('show_alternatives')->default(true);
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
        Schema::dropIfExists('measures');
    }
};
