<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Role extends LaratrustRole
{
    public $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
