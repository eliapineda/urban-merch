<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <nav>
        <a href="{{ route('products.index') }}">Tienda</a>
        @auth
            <span>Hola, {{ auth()->user()->name }}</span>
        @else
            <a href="{{ route('login') }}">Login</a>
        @endauth
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2024 Urban Merch</p>
    </footer>

    @if (session('toast_message'))
        <script>
            alert("{{ session('toast_message') }}"); // Esto lo cambiaremos por un Toast bonito luego
        </script>
    @endif
</body>

</html>
