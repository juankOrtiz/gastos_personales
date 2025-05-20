<?php

namespace App\Http\Controllers;

use App\Helpers\Transacciones;
use Illuminate\Http\Request;

class TransaccionesController extends Controller
{
    public function index() {
        $datos = Transacciones::getDatos();
        return view('transacciones', ['datos' => $datos]);
    }
}
