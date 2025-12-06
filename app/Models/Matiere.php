<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class);
    }
}
