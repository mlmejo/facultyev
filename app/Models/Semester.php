<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = ['start_date', 'end_date', 'current'];

    public function questionnaires(): HasMany
    {
        return $this->hasMany(Questionnaire::class);
    }
}
