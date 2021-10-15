<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends LaratrustRole
{
    public $guarded = [];

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
