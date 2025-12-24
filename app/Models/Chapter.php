<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{
    use HasFactory;
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
        return "Item {$this->numero} - ".\Illuminate\Support\Str::limit($this->description, 80);
    }
    
    public function matieres() : BelongsToMany
    {
        return $this->belongsToMany(Matiere::class, "chapter_matiere", "chapter_id", "matiere_id");
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
