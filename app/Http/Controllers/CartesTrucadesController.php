<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartesTrucadesController extends Controller
{
    public function store(Request $request)
    {
        return redirect()->route('inici');
    }
}
