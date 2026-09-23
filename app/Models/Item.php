<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

#[Fillable([
    'name',
    'icon',
    'subgroup_id',
    'stack_size',

])]
class Item extends Model
{
    public function subgroup(): BelongsTo{
        return $this->belongsTo( Subgroup::class );
    }

    public function recipes(): MorphToMany{
        return $this->morphToMany(Recipe::class, 'object', 'ingredients');
    }
}
