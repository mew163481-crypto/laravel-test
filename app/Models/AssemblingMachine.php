<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'name',
    'icon',
    'next_upgrade',
    'fast_replaceable_group',
    'crafting_speed',
    'stack_size',
    'subgroup_id',

])]
class AssemblingMachine extends Model
{
    public function subgroup(): BelongsTo{
        return $this->belongsTo( Subgroup::class );
    }
    public function craftingCategories(): BelongsToMany{
        return $this->belongsToMany( CraftingCategory::class, 'crafting_categories_to_assembling_machines' );
    }
}
