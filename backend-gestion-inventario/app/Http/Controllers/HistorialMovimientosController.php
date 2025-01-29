<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistorialMovimiento;

class HistorialMovimientosController extends Controller
{
    public function index()
    {
        $lista = HistorialMovimiento::all();
        return response()->json($lista);
    }
}
