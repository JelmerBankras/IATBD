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
        Schema::create('pet_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id')->constrained()->onDelete('cascade'); // Verwijzing naar het huisdier
            $table->foreignId('sitter_id')->constrained('users')->onDelete('cascade'); // Verwijzing naar de oppasser
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade'); // Verwijzing naar de eigenaar
            $table->string('status')->default('pending'); // Status van de aanvraag: 'pending', 'accepted', 'rejected'
            $table->timestamps();
        });
    }
};
