<div class="relative inline-block text-left" data-dropdown>
    <div>
        <button type="button" class="flex items-center p-2 text-white focus:outline-none"
            data-dropdown-button aria-haspopup="true" aria-expanded="true">
            {{ ucfirst(auth()->user()->name) }}
        </button>
    </div>

    <div data-dropdown-panel
        class="dropdown-panel absolute right-0 z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden"
        role="menu" aria-orientation="vertical" aria-labelledby="perfil-button">
        <div class="py-1" role="none">
            <div class="flex items-center justify-between px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <a href="{{ route('dashboard') }}" class="w-full">Perfil</a>
            </div>
            <div class="flex items-center justify-between px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button onclick="event.preventDefault(); this.closest('form').submit();"
                        class="w-full flex hover:cursor-pointer">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
