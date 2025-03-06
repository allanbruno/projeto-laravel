<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Essentia Group')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">
    <header>
        @livewireStyles
        <div class="container d-flex justify-content-center align-items-center mt-3">
            <img src="https://essentiagroup.global/static/media/ho.a335e8fe9332bf2d7218c9e8a3128627.svg"
                 alt="Imagem Centralizada"
                 class="img-fluid"
            >
        </div>
    </header>
    <main>
        @stack('scripts')
        @livewireScripts

        @yield('content')
    </main>
    <footer>
        <div class="container">
            <p>Essentia Group &copy; {{ date('Y') }}</p>
        </div>
    </footer>
</body>
</html>
