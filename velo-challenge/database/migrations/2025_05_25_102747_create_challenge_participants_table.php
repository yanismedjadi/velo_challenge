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
        Schema::create('challenge_participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // user_id INT
            $table->unsignedBigInteger('challenge_id'); // challenge_id INT
            $table->timestamp('joined_at')->useCurrent(); // joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

            // UNIQUE(user_id, challenge_id)
            $table->unique(['user_id', 'challenge_id']);

            // FOREIGN KEYs
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('challenge_id')->references('id')->on('challenges')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challenge_participants');
    }
};
