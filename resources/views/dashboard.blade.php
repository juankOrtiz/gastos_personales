@extends('layouts.app')

@section('titulo', 'Dashboard')

@section('contenido')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">Movimientos por Categoría (Últimos 30 Días)</h2>
            <div id="sin-datos-categorias"
                class="@if(count($labelsGraficoUno) > 0) hidden @endif text-center text-gray-500">
                Aún no tienes movimientos registrados en los últimos 30 días para mostrar.
            </div>
            <canvas id="gastosPorCategoriaChart" class="max-h-96 @if(count($labelsGraficoUno) == 0) hidden @endif"></canvas>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">Movimiento Financiero (Últimos 30 Días)</h2>
            <div id="sin-datos-mensuales"
                class="@if(array_sum($datosGastosMensuales) > 0 || array_sum($datosIngresosMensuales) > 0) hidden @endif text-center text-gray-500">
                Aún no tienes movimientos financieros registrados en los últimos 30 días.
            </div>
            <canvas id="gastosMensualesChart"
                class="max-h-96 @if(array_sum($datosGastosMensuales) == 0 && array_sum($datosIngresosMensuales) == 0) hidden @endif"></canvas>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md flex flex-col justify-center items-center text-center">
            <h2 class="text-xl font-semibold mb-4">Comparación de Gastos</h2>
            <p class="text-gray-600 mb-2">Respecto al mes anterior</p>

            @if ($gastosMesAnterior == 0 && $gastosMesActual == 0)
                <p class="text-gray-500">No hay datos de gastos en ambos meses.</p>
            @else
                <p class="text-4xl font-bold
                    @if ($porcentajeGasto > 0) text-red-500 @else text-green-500 @endif
                ">
                    @if ($porcentajeGasto > 0) +@endif{{ number_format($porcentajeGasto, 1) }}%
                </p>

                <p class="text-2xl font-semibold mt-2
                    @if ($diffGasto > 0) text-red-500 @else text-green-500 @endif
                ">
                    @if ($diffGasto > 0) +@endif${{ number_format(abs($diffGasto), 2) }}
                </p>
            @endif
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">Accesos Rápidos</h2>
            <nav class="flex flex-col gap-4">
                <a href="{{ route('transacciones.index') }}"
                    class="flex items-center gap-2 p-3 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2m-2 4l-2 2m0 0l-2-2m2 2V3" />
                    </svg>
                    <span>Ver todas las transacciones</span>
                </a>
                <a href="{{ route('transacciones.create') }}"
                    class="flex items-center gap-2 p-3 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Crear nueva transacción</span>
                </a>

                @if (auth()->user()->hasRole('admin'))
                    <a href="{{ route('usuarios.index') }}"
                        class="flex items-center gap-2 p-3 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        <span>Ver listado de usuarios</span>
                    </a>
                @endif
            </nav>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Chart.register(ChartDataLabels);
            // Datos recibidos del controlador
            const labelsGraficoUno = @json($labelsGraficoUno);
            const montosGraficoUno = @json($montosGraficoUno);
            const labelsMensuales = @json($labelsMensuales);
            const datosGastosMensuales = @json($datosGastosMensuales);
            const datosIngresosMensuales = @json($datosIngresosMensuales);

            // Gráfico de Movimientos por Categoría
            if (labelsGraficoUno.length > 0) {
                new Chart(
                    document.getElementById('gastosPorCategoriaChart'),
                    {
                        type: 'doughnut',
                        data: {
                            labels: labelsGraficoUno,
                            datasets: [{
                                label: 'Monto en $',
                                data: montosGraficoUno,
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(153, 102, 255)',
                                    'rgb(201, 203, 207)',
                                    'rgb(255, 159, 64)',
                                    'rgb(199, 199, 255)',
                                    'rgb(128, 0, 128)',
                                    'rgb(0, 128, 128)',
                                ],
                                hoverOffset: 4
                            }]
                        },
                        // Configuración para el plugin de datalabels
                        options: {
                            plugins: {
                                datalabels: {
                                    color: '#fff',
                                    formatter: (value, ctx) => {
                                        let sum = 0;
                                        let dataArr = ctx.chart.data.datasets[0].data;
                                        dataArr.map(data => {
                                            sum += data;
                                        });
                                        let percentage = (value * 100 / sum).toFixed(1);
                                        return percentage + '%';
                                    },
                                    font: {
                                        weight: 'bold'
                                    }
                                }
                            }
                        }
                    }
                );
            }

            // Gráfico de Gastos e Ingresos Mensuales
            if (datosGastosMensuales.some(monto => monto > 0) || datosIngresosMensuales.some(monto => monto > 0)) {
                new Chart(
                    document.getElementById('gastosMensualesChart'),
                    {
                        type: 'line',
                        data: {
                            labels: labelsMensuales,
                            datasets: [
                                {
                                    label: 'Gastos',
                                    data: datosGastosMensuales,
                                    borderColor: 'rgb(255, 99, 132)', // Rojo para gastos
                                    tension: 0.1,
                                    fill: false
                                },
                                {
                                    label: 'Ingresos',
                                    data: datosIngresosMensuales,
                                    borderColor: 'rgb(75, 192, 192)', // Verde para ingresos
                                    tension: 0.1,
                                    fill: false
                                }
                            ]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    }
                );
            }
        });
    </script>
@endsection