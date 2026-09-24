<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

#[Fillable([
    'name',
    'icon',
    'subgroup_id',
    'category_id',

])]
class Recipe extends Model
{
    public function subgroup(): BelongsTo
    {
        return $this->belongsTo(Subgroup::class);
    }

    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredient::class);
    }

    public function items(): MorphToMany
    {
        return $this->morphedByMany(Item::class, 'object', 'ingredients')
            ->using(Ingredient::class );
    }

    public function fluids(): MorphToMany
    {
        return $this->morphedByMany(Fluid::class, 'object', 'ingredients')
            ->using(Ingredient::class );
    }
    public function craftingCategories(): HasOne
    {
        return $this->hasMany(CraftingCategory::class);
    }
}
