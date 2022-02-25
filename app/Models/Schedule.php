<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'start_time',
        'end_time',
    ];

    protected $casts = [
        'date' => 'datetime',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function scopeUserSchedule(Builder $builder)
    {
        $builder->where('user_id', auth()->user()->id);
    }

    public function unavailabilities(): HasMany
    {
        return $this->hasMany(ScheduleUnavailability::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
