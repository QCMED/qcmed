<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Question extends Model
{
    use SoftDeletes;
    use HasFactory;

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
        'expected_answer', //Items réponse attendus
        'click_zone', // Zone cliquable pour les questions de type "clickable"
        'status',
        'finalized_at',
    ];

    protected $casts = [
        'finalized_at' => 'datetime',
        'click_zone' => 'array', // Caster le JSON en array
        'expected_answer' => 'array', // Caster le JSON en array
    ];

    /**
     * Retourne le titre de la question pour l'affichage
     */
    public function getTitleAttribute(): string
    {
        return 'Question #' . $this->id . ' - ' . \Illuminate\Support\Str::limit(strip_tags($this->body), 60);
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
        return $this->belongsTo(Dossier::class);
    }

    // public function choices()
    // {
    //     return $this->hasMany(Choice::class);
    // }

    // public function reviews()
    // {
    //     return $this->hasMany(QuestionReview::class);
    // }

    public function scopeFinalized($query)
    {
        return $query->where('status', '2');
    }

    public function scopeInReview($query)
    {
        return $query->where('status', '1');
    }

    public function isDraft(): bool
    {
        return $this->status === '0';
    }

    public function isFinalized(): bool
    {
        return $this->status === '2';
    }
}
