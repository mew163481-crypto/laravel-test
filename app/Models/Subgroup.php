<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'name',
])]
class Subgroup extends Model
{
    public function items(): HasMany{
        return $this->hasMany( Item::class );
    }
    public function a(): HasMany{
        return $this->hasMany( AssemblingMachine::class );
    }

}
