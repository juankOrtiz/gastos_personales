<?php

namespace App\Http\Controllers;

use App\Helpers\Transacciones;
use App\Models\Transaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TransaccionesController extends Controller
{
    private $archivo;
    private $carpeta;

    public function __construct()
    {
        $this->carpeta = storage_path('app/datos');
        $this->archivo = $this->carpeta . '/transacciones.json';

        // Crear la carpeta storage/app/datos si no existe
        File::ensureDirectoryExists($this->carpeta);

        // Si el archivo transacciones.json no existe, lo va a crear con un arreglo vacio
        if(!File::exists($this->archivo)) {
            File::put($this->archivo, json_encode([]));
        }
    }

    public function index() {
        $datos = Transaccion::all();
        return view('transacciones.index', ['datos' => $datos]);
    }

    public function create() {
        return view('transacciones.create');
    }

    public function store(Request $request) {
        // 1) Leer datos del formulario (se inyectan con la variable $request)
        // 2) Validar los datos
        $request->validate([
            'descripcion' => 'required|min:5|max:200',
            'monto' => 'required|numeric|min:0.01',
            'fecha_transaccion' => 'required|date',
        ]);
        // 3) Guardar los datos (en storage/app/datos/transacciones.json)
        $nuevaTransaccion = [
            'id' => uniqid(),
            'user_id' => 1,
            'description' => $request->input('descripcion'),
            'amount' => $request->input('monto'),
            'transaction_date' => $request->input('fecha_transaccion'),
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString(),
        ];
        $transacciones = $this->leerTransacciones();
        $transacciones[] = $nuevaTransaccion;
        $this->guardarTransacciones($transacciones);

        // 4) Redirigir a una nueva ruta con un mensaje
        return redirect()
            ->route('transacciones.index')
            ->with('exito', 'Transaccion creada exitosamente.');
    }

    public function show(string $id) {
        // 1) Buscar la transaccion
        $transaccion = $this->buscarTransaccion($id);
        // 2) Si no existe, redirigir con error
        if(!$transaccion) {
            return redirect()
                ->route('transacciones.index')
                ->with('error', 'Transaccion no encontrada.');
        }
        // 3) Si existe, devolver la vista transacciones.show
        return view('transacciones.show', ['transaccion' => $transaccion]);
    }

    public function edit(string $id) {
        // 1) Buscar la transaccion
        $transaccion = $this->buscarTransaccion($id);
        // 2) Si no existe, redirigir con error
        if(!$transaccion) {
            return redirect()
                ->route('transacciones.index')
                ->with('error', 'Transaccion no encontrada.');
        }
        // 3) Si existe, devolver la vista transacciones.edit
        return view('transacciones.edit', ['transaccion' => $transaccion]);
    }

    public function update(Request $request, string $id) {
        // 1) Leer datos del formulario (se inyectan con la variable $request)
        // 2) Validar los datos
        $request->validate([
            'descripcion' => 'required|min:5|max:200',
            'monto' => 'required|numeric|min:0.01',
            'fecha_transaccion' => 'required|date',
        ]);
        // 3) Actualizar los datos (en storage/app/datos/transacciones.json)
        $transacciones = $this->leerTransacciones();
        $encontrado = false;

        foreach($transacciones as $clave => $transaccion) {
            if($transaccion['id'] == $id) {
                $transacciones[$clave]['description'] = $request->input('descripcion');
                $transacciones[$clave]['amount'] = $request->input('monto');
                $transacciones[$clave]['transaction_date'] = $request->input('fecha_transaccion');
                $transacciones[$clave]['updated_at'] = now()->toDateTimeString();
                $encontrado = true;
                break;
            }
        }

        if(!$encontrado) {
            return redirect()
                ->route('transacciones.index')
                ->with('error', 'La transaccion no existe.');
        }

        $this->guardarTransacciones($transacciones);

        // 4) Redirigir a una nueva ruta con un mensaje
        return redirect()
            ->route('transacciones.index')
            ->with('exito', 'Transaccion actualizada exitosamente.');
    }

    public function destroy(string $id) {
        // Pretendemos eliminar el elemento
        return redirect()
            ->route('transacciones.index')
            ->with('exito', 'Transaccion eliminada.');
    }

    private function leerTransacciones(): array {
        $contenido = File::get($this->archivo);
        return json_decode($contenido, true);
    }

    private function guardarTransacciones(array $transacciones): void {
        $contenido = json_encode($transacciones, JSON_PRETTY_PRINT);
        File::put($this->archivo, $contenido);
    }

    private function buscarTransaccion(string $id): ?array {
        $transacciones = $this->leerTransacciones();
        foreach($transacciones as $transaccion) {
            if($transaccion['id'] == $id) {
                return $transaccion;
            }
        }
        return null;
    }
}
