<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Project extends Base\Project
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
