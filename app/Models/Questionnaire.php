<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Questionnaire extends Model
{
    use HasFactory;

    protected $fillable = ['semester_id'];

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }
}
