<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const TYPE_QCM = 0;

    public const TYPE_QROC = 1;

    public const TYPE_QZONE = 2;

    public const STATUS_DRAFT = 0;

    public const STATUS_TO_BE_REVIEWED = 1;

    public const STATUS_FINALIZED = 2;

    protected $fillable = [
        'user_id',
        'dossier_id',
        'chapter_id',
        'type',
        'proposed_count',
        'stand_alone',
        'body',
        'image',
        'correction',
        'expected_answer', // Items réponse attendus
        'click_zone', // Zone cliquable pour les questions de type "clickable"
        'status',
        'finalized_at',
    ];

    protected $casts = [
        'finalized_at' => 'datetime',
        'click_zone' => 'array', // Caster le JSON en array - pourquoi?
        'expected_answer' => 'array', // Caster le JSON en array
    ];

    /**
     * Retourne le titre de la question pour l'affichage
     */
    public function getTitleAttribute(): string
    {
        if (! $this->exists) {
            return 'Nouvelle question';
        }

        $body = strip_tags($this->body ?? '');
        $excerpt = ! empty($body) ? \Illuminate\Support\Str::limit($body, 60) : 'Sans énoncé';

        return "Question #{$this->id} - {$excerpt}";
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function dossier()
    {
        return $this->belongsTo(Dossier::class)->withDefault();
    }

    public function learningObjectives(): BelongsToMany
    {
        return $this->belongsToMany(LearningObjective::class);
    }

    // public function reviews()
    // {
    //     return $this->hasMany(QuestionReview::class);
    // }

    public function scopeFinalized($query)
    {
        return $query->where('status', self::STATUS_FINALIZED);
    }

    public function scopeInReview($query) // Pas si utile?
    {
        return $query->where('status', '1');
    }

    public function isDraft(): bool
    {
        return $this->status === self::STATUS_DRAFT;
    }

    public function isFinalized(): bool
    {
        return $this->status === self::STATUS_FINALIZED;
    }

    public function scopeQuestionIsolee(Builder $query)
    {
        return $query->where('dossier_id', '=', null);
    }

    public function scopeQuestionDossier(Builder $query)
    {
        return $query->whereNot('dossier_id', '=', null);
    }
}
