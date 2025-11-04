<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include( 'frontend.layouts.head')
<!-- Importando alphine js para efectos -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


<body class="bg-[#FDFDFC] text-[#1b1b18]">

    @include( 'frontend.layouts.navigator')

    {{-- Contenido principal --}}
    <main class="bg-gray-50 min-h-screen ">
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<!-- JS Propios -->
<script src="js/main.js"></script>
</body>


</html>