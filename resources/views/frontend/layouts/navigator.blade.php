@if (Route::has('login'))
<nav 
    class="relative w-full text-sm mb-6 shadow-md"
    style="background-color: var(--azul-oscuro-1); color: #FFFFFF;"
    x-data="{ open: false, userMenu: false }">

    <div class="container mx-auto px-4">
        <div class="relative flex h-16 items-center justify-between">

            <!-- Botón menú móvil -->
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <button @click="open = !open" type="button"
                    class="inline-flex items-center justify-center rounded-md p-2 text-white hover:bg-[#1A5276]/50 focus:outline-none">
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Logo + enlaces -->
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex shrink-0 items-center">
                    <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg"
                         alt="Logo" class="h-8 w-auto" />
                </div>

                <!-- Enlaces desktop -->
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        <a href="{{ route('home') }}" 
                           class="rounded-md px-3 py-2 text-sm font-medium bg-[#1A5276] text-white">Inicio</a>
                        <a href="#" 
                           class="rounded-md px-3 py-2 text-sm font-medium text-gray-200 hover:bg-[#1A5276]/70">Nosotros</a>
                        <a href="#" 
                           class="rounded-md px-3 py-2 text-sm font-medium text-gray-200 hover:bg-[#1A5276]/70">Contacto</a>
                    </div>
                </div>
            </div>

            <!-- Autenticación -->
            <div class="absolute inset-y-0 right-0 flex items-center sm:static sm:inset-auto sm:ml-6 sm:pr-0 space-x-2">
                @auth
                    <a href="{{ route('dashboard') }}" 
                       class="rounded-md px-3 py-2 text-sm font-semibold text-[#0B3C5D]"
                       style="background-color: #1ABC9C;"
                       onmouseover="this.style.backgroundColor='#17A589'"
                       onmouseout="this.style.backgroundColor='#1ABC9C'">
                        Dashboard
                    </a>

                    <!-- Menú usuario -->
                    <div class="relative" x-data="{ userMenu: false }">
                        <button @click="userMenu = !userMenu"
                                class="flex items-center text-gray-200 hover:text-white rounded-md px-3 py-2 text-sm font-medium focus:outline-none">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="ml-1 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="userMenu" @click.outside="userMenu = false"
                             x-transition
                             class="absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                            <div class="py-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                        Cerrar sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" 
                       class="rounded-md px-3 py-2 text-sm font-semibold text-[#0B3C5D]"
                       style="background-color: #16A085; color: #fafafa;"
                           onmouseover="this.style.backgroundColor='#138D75'"
                           onmouseout="this.style.backgroundColor='#16A085'">
                        Ingresar
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" 
                           class="rounded-md px-3 py-2 text-sm font-semibold text-[#0B3C5D]"
                           
                           style="color:#fafafa;"
                            onmouseover="this.style.color='#17A589'"
                            onmouseout="this.style.color='#fafafa'">
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
        class="sm:hidden bg-[#0B3C5D]">
        <div class="space-y-1 px-2 pt-2 pb-3">
            <a href="{{ route('home') }}" class="block rounded-md bg-[#1A5276] px-3 py-2 text-base font-medium text-white">Inicio</a>
            <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-200 hover:bg-[#1A5276]/70">Nosotros</a>
            <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-200 hover:bg-[#1A5276]/70">Contacto</a>

            @auth
                <a href="{{ route('dashboard') }}" 
                   class="block rounded-md px-3 py-2 text-base font-medium text-[#0B3C5D]"
                   style="background-color: #1ABC9C;">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left block rounded-md px-3 py-2 text-base font-medium text-red-500 hover:bg-[#1A5276]/60 hover:text-white">
                        Cerrar sesión
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" 
                   class="block rounded-md px-3 py-2 text-base font-medium text-[#0B3C5D]"
                   style="background-color: #1ABC9C;">Ingresar</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" 
                       class="block rounded-md px-3 py-2 text-base font-medium text-[#0B3C5D]"
                       style="background-color: #16A085;">Registrarse</a>
                @endif
            @endauth
        </div>
    </div>
</nav>
@endif
