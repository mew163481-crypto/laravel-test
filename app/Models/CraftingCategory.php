<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'name',

])]
class CraftingCategory extends Model
{
    public function ingredient(): HasOne{
        return $this->hasMany(Recipe::class);
    }
    public function assemblingMachines(): BelongsToMany{
        return $this->belongsToMany( AssemblingMachine::class, 'crafting_categories_to_assembling_machines' );
    }
}
