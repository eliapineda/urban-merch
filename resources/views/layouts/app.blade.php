<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Urban Merch')</title>

    {{-- Fuentes y CSS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Freckle+Face&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- Tailwind (Vite) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- Detectamos si es la ruta home para cambiar el fondo --}}
<body class="min-h-screen flex flex-col {{ request()->routeIs('home') ? '' : 'bg-gray-50' }}">

    <nav class="flex flex-col md:flex-row justify-between md:justify-evenly items-center p-4 bg-gray-900 text-white gap-4 md:gap-0">
        <div class="order-2 md:order-1">
            <a href="{{ route('products.index') }}" class="font-bold text-lg md:text-xl hover:text-gray-300 transition">PRODUCTOS</a>
        </div>

        <div class="order-1 md:order-2">
            <a href="{{ route('home') }}" class="font-title text-4xl md:text-7xl">URBAN MERCH</a>
        </div>

        <div class="flex gap-6 text-xl order-3">
            {{-- Perfil --}}
            <div>
                <a href="{{ route('profile.show') }}" class="hover:text-gray-300 transition">
                    <i class="fa-solid fa-user"></i>
                </a>
            </div>

            {{-- Carrito --}}
            <div>
                <a href="{{ route('cart.index') }}" class="hover:text-gray-300 transition">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
            </div>

            {{-- Panel Admin (Solo si el usuario tiene rol admin) --}}
            @auth
                @if(auth()->user()->role === 'admin')
                    <div>
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-300 transition">
                            <i class="fa-solid fa-screwdriver-wrench"></i>
                        </a>
                    </div>
                @endif
            @endauth
        </div>
    </nav>

    {{-- Contenedor principal --}}
    <main class="flex-1 w-full {{ request()->routeIs('home') ? '' : 'max-w-7xl mx-auto p-4 md:p-6' }}">
        @yield('content')
    </main>

    {{-- Aquí iría tu footer --}}
    <footer class="bg-gray-900 text-white py-6 text-center">
        <p>&copy; {{ date('Y') }} Urban Merch. Todos los derechos reservados.</p>
    </footer>

</body>
</html>
