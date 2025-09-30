<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- La vista debe definir el titulo, sino se aplica el segundo argumento como titulo de la pagina -->
    <title>@yield('titulo', 'Mis Gastos Personales')</title>
    @vite(['resources/css/app.css', 'resources/js/dropdowns.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
</head>

<body class="bg-gray-100 text-gray-900">
    <x-menu />

    <main class="container mx-auto mt-8">
        @yield('contenido')
    </main>
</body>

</html>
