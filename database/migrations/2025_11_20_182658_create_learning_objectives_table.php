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
        Schema::create('learning_objectives', function (Blueprint $table) {
            $table->id();
            $table->integer('chapter_numero')->comment('Numéro du chapitre associé');
            $table->string('rang')->comment('Rang de l\'objectif');
            $table->string('rubrique')->comment('Rubrique de l\'objectif');
            $table->text('intitule')->comment('Intitulé de l\'objectif d\'apprentissage');
            $table->foreign('chapter_numero')->references('numero')->on('chapters')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_objectives');
    }
};
