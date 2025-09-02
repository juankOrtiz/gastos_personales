<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Mis Gastos Personales')</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-green-100 text-gray-900">
    <main class="container mx-auto mt-8">
        @yield('contenido')
    </main>
</body>
</html>