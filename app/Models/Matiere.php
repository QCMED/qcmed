<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Matiere extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'matieres';

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Une matière possède plusieurs chapitres.
     */
    public function chapters(): BelongsToMany
    {
        return $this->belongsToMany(Chapter::class, "chapter_matiere")
        ;
    }
}
