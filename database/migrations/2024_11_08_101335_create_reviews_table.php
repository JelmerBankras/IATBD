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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_id'); // Verwijzing naar het verzoek
            $table->unsignedBigInteger('owner_id'); // De gebruiker die de review plaatst
            $table->unsignedBigInteger('sitter_id'); // De oppasser die beoordeeld wordt
            $table->integer('rating')->unsigned(); // Bijv. van 1-5
            $table->text('comment')->nullable(); // Optionele commentaar
            $table->timestamps();

            $table->foreign('request_id')->references('id')->on('pet_requests')->onDelete('cascade');
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sitter_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
