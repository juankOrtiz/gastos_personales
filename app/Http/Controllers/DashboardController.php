<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaccion;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // 1. Datos para el gráfico de movimientos por categoría
        $transaccionesRecientes = Transaccion::where('user_id', $user->id)
            ->where('fecha_transaccion', '>=', Carbon::now()->subDays(30))
            ->with('categoria')
            ->get();

        // Agrupar las transacciones por categoría, calcular el monto total y ordenar
        $datosGraficoUno = $transaccionesRecientes->groupBy('categoria_id')
            ->map(function ($transacciones) {
                $montoTotal = $transacciones->sum('monto');
                $categoria = $transacciones->first()->categoria;
                return [
                    'label' => $categoria->nombre . ' (' . ucfirst($categoria->tipo) . ')',
                    'monto' => $montoTotal,
                ];
            })
            ->sortByDesc('monto')
            ->values();

        $labelsGraficoUno = $datosGraficoUno->pluck('label')->toArray();
        $montosGraficoUno = $datosGraficoUno->pluck('monto')->toArray();

        // 2. Datos para los gráficos de los últimos 30 días
        $gastosDiarios = $transaccionesRecientes->where('categoria.tipo', 'gasto')->groupBy(function ($transaccion) {
            return Carbon::parse($transaccion->fecha_transaccion)->format('Y-m-d');
        });

        $ingresosDiarios = $transaccionesRecientes->where('categoria.tipo', 'ingreso')->groupBy(function ($transaccion) {
            return Carbon::parse($transaccion->fecha_transaccion)->format('Y-m-d');
        });

        $labelsMensuales = [];
        $datosGastosMensuales = [];
        $datosIngresosMensuales = [];

        $fechaActual = Carbon::now()->subDays(29);
        while ($fechaActual <= Carbon::now()) {
            $fecha = $fechaActual->format('Y-m-d');
            $labelsMensuales[] = $fechaActual->format('d/m');

            $montoGastoDiario = isset($gastosDiarios[$fecha]) ? $gastosDiarios[$fecha]->sum('monto') : 0;
            $montoIngresoDiario = isset($ingresosDiarios[$fecha]) ? $ingresosDiarios[$fecha]->sum('monto') : 0;

            $datosGastosMensuales[] = $montoGastoDiario;
            $datosIngresosMensuales[] = $montoIngresoDiario;

            $fechaActual->addDay();
        }

        $gastosMesActual = Transaccion::where('user_id', $user->id)
            ->whereHas('categoria', function ($query) {
                $query->where('tipo', 'gasto');
            })
            ->whereMonth('fecha_transaccion', Carbon::now()->month)
            ->whereYear('fecha_transaccion', Carbon::now()->year)
            ->sum('monto');

        $gastosMesAnterior = Transaccion::where('user_id', $user->id)
            ->whereHas('categoria', function ($query) {
                $query->where('tipo', 'gasto');
            })
            ->whereMonth('fecha_transaccion', Carbon::now()->subMonth()->month)
            ->whereYear('fecha_transaccion', Carbon::now()->subMonth()->year)
            ->sum('monto');

        $diffGasto = $gastosMesActual - $gastosMesAnterior;

        // Manejar el caso de división por cero si no hubo gastos el mes anterior
        $porcentajeGasto = ($gastosMesAnterior > 0)
            ? (($diffGasto / $gastosMesAnterior) * 100)
            : 100;

        return view('dashboard', [
            'labelsGraficoUno' => $labelsGraficoUno,
            'montosGraficoUno' => $montosGraficoUno,
            'labelsMensuales' => $labelsMensuales,
            'datosGastosMensuales' => $datosGastosMensuales,
            'datosIngresosMensuales' => $datosIngresosMensuales,
            'gastosMesActual' => $gastosMesActual,
            'gastosMesAnterior' => $gastosMesAnterior,
            'diffGasto' => $diffGasto,
            'porcentajeGasto' => $porcentajeGasto,
        ]);
    }
}