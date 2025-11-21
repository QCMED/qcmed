<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'numero',
        'description',
    ];

    /**
     * Retourne le titre du chapitre pour l'affichage
     */
    public function getNameAttribute(): string
    {
        return "Item {$this->numero} - " . \Illuminate\Support\Str::limit($this->description, 80);
    }

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
