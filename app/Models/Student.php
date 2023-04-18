<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['course_id'];

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
