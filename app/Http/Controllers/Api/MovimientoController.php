<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Movimiento;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{
    public function getMovements() {
        $movimientos = Movimiento::all();
        return response()->json($movimientos);
    }
}
