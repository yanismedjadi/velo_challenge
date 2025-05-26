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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('user_id'); // FK vers users.id
            // Clé étrangère vers la table users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('challenge_id'); // FK vers challenges.id
            // Clé étrangère vers la table users
            $table->foreign('challenge_id')->references('id')->on('challenges')->onDelete('cascade');

            $table->dateTime('date'); // Date de l'activité
            $table->float('distance_km', 6, 3); // distance totale parcourue
            $table->float('rain', 6, 3); // distance parcourue sous pluie
            $table->float('night', 6, 3); // distance parcourue la nuit
            $table->float('with_kids', 6, 3); // distance parcourue avec des enfants                       

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
