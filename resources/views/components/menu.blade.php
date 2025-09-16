<nav class="bg-blue-500 p-4 text-white flex justify-between">
    <ul class="flex space-x-4">
        <li>
            <a href="{{ route('inicio') }}"
                class="{{ request()->routeIs('inicio') ? 'font-bold underline' : 'hover:underline' }}">Inicio</a>
        </li>
        <li>
            <a href="{{ route('transacciones.index') }}"
                class="{{ request()->routeIs('transacciones.index') ? 'font-bold underline' : 'hover:underline' }}">Transacciones</a>
        </li>
        <li>
            <a href="{{ route('comprobantes.index') }}"
                class="{{ request()->routeIs('comprobantes.index') ? 'font-bold underline' : 'hover:underline' }}">Comprobantes</a>
        </li>
        @can('ver-listado-usuarios')
            <li>
                <a href="{{ route('usuarios.index') }}"
                    class="{{ request()->routeIs('usuarios.index') ? 'font-bold underline' : 'hover:underline' }}">Usuarios</a>
            </li>
        @endcan
    </ul>
    @auth
        <div class="flex items-center ml-4">
            <x-notifications />
            <x-enlaces-perfil />
        </div>
    @endauth
</nav>
