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
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // VARCHAR
            $table->text('description'); // VARCHAR ou TEXT selon la longueur
            $table->string('category'); // catégorie : libre selon ton besoin
            $table->enum('difficulty', ['debutant', 'intermediaire', 'avance']); // énumération
            $table->dateTime('start_date'); // DATETIME
            $table->dateTime('end_date'); // DATETIME
            $table->unsignedBigInteger('created_by'); // FK vers users.id

            // Clé étrangère vers la table users
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challenges');
    }
};
