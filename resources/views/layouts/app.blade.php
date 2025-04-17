<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    <main class="py-6 px-4 sm:px-6 lg:px-8">
        @yield('content')
    </main>
</div>
</body>
</html>
