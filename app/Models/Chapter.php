<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chapter extends Model
{
    protected $fillable = [
        'numero',
        'description',
    ];

    /**
     * Récupère les objectifs d'apprentissage de ce chapitre
     */
    public function learningObjectives(): HasMany
    {
        return $this->hasMany(LearningObjective::class, 'chapter_numero', 'numero');
    }

    /**
     * Récupère les questions de ce chapitre
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
