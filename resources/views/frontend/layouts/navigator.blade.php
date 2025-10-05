@if (Route::has('login'))
    <nav class="relative w-full bg-gray-800 text-sm mb-6" x-data="{ open: false }">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">

                <!-- Botón menú móvil -->
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <button @click="open = !open" type="button"
                        class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-white/5 hover:text-white focus:outline-2 focus:-outline-offset-1 focus:outline-indigo-500">
                        <span class="sr-only">Open main menu</span>

                        <!-- Ícono hamburguesa -->
                        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5"
                            class="size-6 transition-all duration-200">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>

                        <!-- Ícono cerrar -->
                        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5"
                            class="size-6 transition-all duration-200">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Logo -->
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex shrink-0 items-center">
                        <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                            alt="Logo" class="h-8 w-auto" />
                    </div>

                    <!-- Links desktop -->
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <a href="#" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white">Inicio</a>
                            <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">Proyectos</a>
                            <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">Servicios</a>
                            <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">Contacto</a>
                        </div>
                    </div>
                </div>

                <!-- Autenticación -->
                <div
                    class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="ml-2">
                            @csrf
                            <button type="submit"
                                class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">
                                Cerrar sesión
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">
                            Ingresar
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">
                                Registrarse
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>

        <!-- Menú móvil -->
        <div x-show="open" x-transition
            @click.outside="open = false"
            class="sm:hidden bg-gray-800">
            <div class="space-y-1 px-2 pt-2 pb-3">
                <a href="#" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white">Inicio</a>
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Proyectos</a>
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Servicios</a>
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Contacto</a>

                @auth
                    <a href="{{ route('dashboard') }}"
                        class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">
                            Cerrar sesión
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">
                        Ingresar
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">
                            Registrarse
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>


@endif