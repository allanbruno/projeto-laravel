<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Essentia Group')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<header>
    @livewireStyles
    <h1>Meu Header</h1>
</header>
<main>
    @stack('scripts')
    @livewireScripts

    @yield('content')
</main>
<footer>
    <p>Essentia Group &copy; {{ date('Y') }}</p>
</footer>
</body>
</html>
