<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Mis Gastos Personales')</title>
    @vite(['resources/css/app.css'])
</head>
<body class="text-gray-900">
    @yield('contenido')
</body>
</html>