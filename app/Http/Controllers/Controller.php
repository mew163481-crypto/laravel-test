<?php

namespace App\Http\Controllers;

use App\Models\AssemblingMachine;

abstract class Controller
{
    public function test(){
        $test=AssemblingMachine::first();
        $test->craftingCategories;
    }
}
