<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[Fillable([
    'object_id',
    'object_type',
    'recipe_id',
    'amount',
    'fluidbox_multiplier',
])]


class Ingredient extends Model
{
    public function recipe(): BelongsTo{
        return $this->belongsTo( Recipe::class );
    }

    public function object(): MorphTo{
        return $this->morphTo();
    }
}
