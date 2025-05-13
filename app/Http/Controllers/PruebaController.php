<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PruebaController extends Controller
{
    public function index() {
        echo "Hola desde el controlador PruebaController";
    }

    public function crear() {
        echo "Formulario para crear";
    }
}
