<?php

namespace App\Http\Controllers;

use App\Models\FormatTwo;
use Illuminate\Http\Request;

class Portalf2Controller extends Controller
{
    public function actForm()
    {
        return view('f2');
    }
}
