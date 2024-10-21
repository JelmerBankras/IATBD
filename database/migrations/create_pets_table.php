
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();  // Auto-incrementing ID for each pet
            $table->string('name');  // Name of the pet
            $table->string('species');  // Pet species (dog, cat, etc.)
            $table->integer('age');  // Age of the pet
            $table->string('image');  // Path to the image of the pet
            $table->unsignedBigInteger('user_id');  // ID of the user who owns the pet
            $table->timestamps();  // Laravel managed created_at and updated_at fields

            // Define foreign key constraint linking the user_id to users table (if users table exists)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('pets');
    }
};
