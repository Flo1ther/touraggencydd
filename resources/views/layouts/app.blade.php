<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="min-h-screen bg-white-100 dark:bg-white-900">
    <main class="py-6 px-4 sm:px-6 lg:px-8">
        @yield('content')
        <hr class="border-t border-gray-300 my-8">

        <footer class="bg-gray-800 text-white py-6 mt-20">
            <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center text-sm space-y-2 md:space-y-0">
                <p>&copy; {{ date('Y') }} TravelPro. Всі права захищені.</p>
                <div class="flex space-x-4">
                    <a href="{{ route('home') }}" class="hover:underline">Головна</a>
                    <a href="{{ route('contacts') }}" class="hover:underline">Контакти</a>
                    <a href="{{ route('public.posts.index') }}" class="hover:underline">Блог</a>
                </div>
            </div>
        </footer>


    </main>
</div>
</body>
</html>
