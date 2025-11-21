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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('chapter_id')->constrained('chapters')->cascadeOnDelete();
            $table->integer('type')->defautl(0); // 0 QCM | 1 QROC | 2 QZONE
            $table->integer('proposed_count')->nullable(); // montrer à l'étudiant ou pas le nombre de réponses vraies
            $table->boolean('stand_alone')->default('1'); // 1 QI | 0 Dossier
            $table->text('body');
            $table->text('correction')->nullable();
            $table->text('expected_answer')->nullable();
            $table->text('click_zone')->nullable();
            $table->integer('status')->default('0'); // 0 draft | 1 in_review | 2 finalized
            $table->timestamp('finalized_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
