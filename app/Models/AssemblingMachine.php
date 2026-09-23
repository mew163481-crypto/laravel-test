<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'name',
    'icon',
    'next_upgrade',
    'crafting_category',
    'crafting_speed',
    'stack_size',

])]
class AssemblingMachine extends Model
{
    public function craftingcategory(): BelongsTo{
        return $this->belongsTo( CraftingCategory::class );
    }
}
