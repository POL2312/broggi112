<?php

namespace App\Http\Controllers;

use App\Models\Municipi;
use Illuminate\Http\Request;

class MunicipiController extends Controller
{
    public function getMunicipis()
    {
        $municipis = Municipi::all();
        return response()->json($municipis);
    }
}
