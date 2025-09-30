<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema; 

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->string('IMDB', 9)->primary(); // Chave primária com 9 caracteres
            $table->string('title', 150);
            $table->string('description', 300);
            $table->string('director', 100);
            $table->string('genre', 50);
            $table->integer('releaseYear');
            $table->integer('duration');
            $table->float('note');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
