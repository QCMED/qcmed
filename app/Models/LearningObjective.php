<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LearningObjective extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'rang',
        'rubrique',
        'intitule',
        'chapter_numero',
    ];

    protected $casts = [
        
    ];

    /**
     * Récupère le chapitre auquel appartient cet objectif
     */
    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class, 'chapter_numero', 'numero');
    }
}
