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
    <h1>Meu Header</h1>
</header>
<main>
    @yield('content')
</main>
<footer>
    <p>Essential Group &copy; {{ date('Y') }}</p>
</footer>
</body>
</html>
