<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'property',
    'max',
    'min',
])]
class SurfaceCondition extends Model
{
    //
}
