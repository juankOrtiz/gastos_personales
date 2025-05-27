<nav class="bg-blue-500 p-4 text-white">
    <ul class="flex space-x-4">
        <li>
            <a href="{{ route('inicio') }}" class="{{ request()->routeIs('inicio') ? 'font-bold underline' : 'hover:underline' }}">Inicio</a>
        </li>
        <li>
            <a href="{{ route('prueba.index') }}" class="{{ request()->routeIs('prueba.index') ? 'font-bold underline' : 'hover:underline' }}">Prueba</a>
        </li>
        <li>
            <a href="{{ route('transacciones.index') }}" class="{{ request()->routeIs('transacciones.index') ? 'font-bold underline' : 'hover:underline' }}">Transacciones</a>
        </li>
    </ul>
</nav>