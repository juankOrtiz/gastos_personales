<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrearComprobanteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class ComprobantesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Leer todos los comprobantes del disco
        $archivos = Storage::disk('public')->files('comprobantes');
        // Recorrer los archivos y extraer la info necesaria
        $infoArchivos = collect($archivos)->map(function($arch) {
            return [
                'nombre' => basename($arch),
                'ruta' => $arch,
                'url' => Storage::url($arch),
            ];
        });

        return view('comprobantes.index', compact('infoArchivos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('comprobantes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CrearComprobanteRequest $request)
    {
        // 1) Validar el archivo (ya se hace en el FormRequest)
        // 2) Validar que el usuario tenga permisos (mas adelante)
        // 3) Mover el archivo al disco local
        $comprobante = $request->file('comprobante');
        $comprobante->store('comprobantes', 'public');
        // 4) Subir a la BD (mas adelante)
        // 5) Redirigir a la pagina anterior con mensaje
        return back()->with([
            'exito' => 'Se ha guardado el comprobante'
        ]);
    }
}
