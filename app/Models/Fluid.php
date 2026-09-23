<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;


#[Fillable([
    'damage_modifier',
    'icon',
    'ammo_category',
    'ammo_type',
    'fluid_consumption',


])]
class Fluid extends Model
{
    public function recipes(): MorphToMany{
        return $this->morphToMany(Recipe::class, 'object', 'ingredients');
    }
}
