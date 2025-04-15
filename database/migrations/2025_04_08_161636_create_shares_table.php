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
        Schema::create('shares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mix_id');
            $table->json('mix');
            $table->foreign('mix_id')->references('id')->on('mixes')->onDelete('cascade');
            $table->boolean('responded')->nullable()->default(null);
            $table->boolean('accepted')->nullable()->default(null);
            $table->unsignedBigInteger('target_user');
            $table->string('message')->nullable();
            $table->string('name')->nullable();
            $table->foreign('target_user')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shares');
    }
};
