<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Dossier extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function delete()
    {
        DB::transaction(function() {
            $this->questions()->delete();
            parent::delete();
        });
    }

    public function forceDelete()
    {
        DB::transaction(function() {
            $this->questions()->forceDelete();
            parent::delete(); // Finally, delete the dossier
        });
    }
}
