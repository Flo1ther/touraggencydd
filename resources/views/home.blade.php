@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50">

        {{-- Хедер --}}
        <header class="bg-white shadow mb-4">
            <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
                <div class="text-3xl font-bold text-blue-600">
                    TravelMate
                </div>

                <nav class="flex space-x-6 items-center">
                    <a href="{{ route('index') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">Тури</a>
                    <a href="{{ route('public.posts.index') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">Пости</a>
                    <a href="{{ route('contacts') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">Контакти</a>
                    @guest
                        <button
                            class="text-gray-700 hover:text-blue-600 font-medium transition"
                            onclick="document.getElementById('auth-modal').classList.remove('hidden')"
                        >
                            Увійти / Зареєструватися
                        </button>
                    @else
                        <a href="{{ route('profile.index') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">Мій профіль</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-blue-600 font-medium transition">Вийти</button>
                        </form>
                    @endguest
                </nav>
            </div>
        </header>

        {{-- Flash messages --}}
        @if (session('status'))
            <div class="max-w-7xl mx-auto px-6">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('status') }}
                </div>
            </div>
        @endif

        {{-- Модальне вікно логіну/реєстрації --}}
        @include('components.auth-modal')

        {{-- Hero секція --}}
        <section class="bg-cover bg-center" style="background-image: url('{{ asset('uploads/placeholder.jpg') }}'); min-height: 400px;">
            <div class="bg-black bg-opacity-50 min-h-full flex flex-col justify-center items-center text-center text-white p-8">
                <h1 class="text-3xl font-bold mb-4">Найкращі тури по Україні та світу — лише тут!</h1>
                <a href="{{ route('index') }}" class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-3 rounded transition">Обрати тур</a>
            </div>
        </section>

        {{-- Пошук та фільтри --}}
        <section class="bg-white shadow p-6 max-w-7xl mx-auto -mt-8 z-10 relative rounded-lg">

            {{-- Основна форма пошуку --}}
            <form method="GET" action="{{ route('index') }}" class="grid grid-cols-1 md:grid-cols-6 gap-4 mb-4">
                <input type="text" name="location" class="form-control rounded border-gray-300 p-2 col-span-2" placeholder="Країна / місто / готель" value="{{ request('location') }}">
                <input type="text" name="from" class="form-control rounded border-gray-300 p-2" placeholder="Звідки" value="{{ request('from') }}">
                <input type="date" name="start_date" class="form-control rounded border-gray-300 p-2" value="{{ request('start_date') }}">
                <input type="date" name="end_date" class="form-control rounded border-gray-300 p-2" value="{{ request('end_date') }}">
                <input type="number" name="duration" class="form-control rounded border-gray-300 p-2" placeholder="Днів" value="{{ request('duration') }}">
                <div class="flex space-x-2">
                    <input type="number" name="adults" class="form-control rounded border-gray-300 p-2 w-1/2" placeholder="Дорослі" value="{{ request('adults') }}">
                    <input type="number" name="children" class="form-control rounded border-gray-300 p-2 w-1/2" placeholder="Діти" value="{{ request('children') }}">
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded col-span-1 md:col-span-1">Пошук</button>
            </form>

            {{-- Розширений фільтр --}}
            <button
                type="button"
                onclick="document.getElementById('advanced-filters').classList.toggle('hidden')"
                class="text-blue-600 hover:underline mb-4"
            >
                Розширений пошук
            </button>

            <form method="GET" action="{{ route('index') }}" id="advanced-filters" class="hidden grid grid-cols-1 md:grid-cols-5 gap-4">
                <select name="category_id" class="form-control rounded border-gray-300">
                    <option value="">Категорія</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <select name="services[]" class="form-control rounded border-gray-300 text-black" multiple>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}" {{ collect(request('services'))->contains($service->id) ? 'selected' : '' }}>
                            {{ $service->title }}
                        </option>
                    @endforeach
                </select>


                <input type="number" name="min_price" class="form-control rounded border-gray-300" placeholder="Мін. ціна" value="{{ request('min_price') }}">
                <input type="number" name="max_price" class="form-control rounded border-gray-300" placeholder="Макс. ціна" value="{{ request('max_price') }}">

                <select name="rating" class="form-control rounded border-gray-300">
                    <option value="">Оцінка</option>
                    @for ($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>
                            {{ $i }} ★
                        </option>
                    @endfor
                </select>

                <select name="transport" class="form-control rounded border-gray-300">
                    <option value="">Транспорт</option>
                    <option value="bus" {{ request('transport') == 'bus' ? 'selected' : '' }}>Автобус</option>
                    <option value="plane" {{ request('transport') == 'plane' ? 'selected' : '' }}>Літак</option>
                    <option value="train" {{ request('transport') == 'train' ? 'selected' : '' }}>Поїзд</option>
                </select>

                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded">Застосувати фільтри</button>
            </form>
        </section>

        {{-- Гарячий тур --}}
        @if ($hotTour)
            <section class="max-w-7xl mx-auto px-6 py-16">
                <h2 class="text-3xl font-bold mb-8 text-center text-blue-600">🔥 Гарячий тур!</h2>
                <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col md:flex-row">
                    <img src="{{ asset('storage/tours/' . $hotTour->image) }}" alt="Гарячий тур" class="w-full md:w-1/2 h-64 object-cover">
                    <div class="p-6 flex flex-col justify-center">
                        <h3 class="text-2xl font-bold mb-3">{{ $hotTour->title }}</h3>
                        <p class="text-gray-700 mb-4">{{ $hotTour->description }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-semibold text-green-600">від {{ $hotTour->price }} ₴</span>
                            <a href="{{ route('show', $hotTour) }}">Детальніше</a>


                        </div>
                    </div>
                </div>
            </section>
        @endif


        {{-- Останні тури --}}
        <section class="max-w-7xl mx-auto px-6 py-16">
            <h2 class="text-2xl font-semibold mb-6">Останні тури</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($tours as $tour)
                    @php
                        $imagePath = $tour->images->first()->image_path ?? null;
                        $imageSrc = $imagePath ? asset('storage/' . $imagePath) : asset('storage/images/placeholder.jpg');
                    @endphp
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                        <img src="{{ $imageSrc }}" alt="{{ $tour->title }}" class="w-full h-48 object-cover">
                        <div class="p-5">
                            <h3 class="text-lg font-bold mb-2">{{ $tour->title }}</h3>
                            <p class="text-gray-600 text-sm mb-3">{{ Str::limit($tour->description, 100) }}</p>
                            <p class="text-gray-800 text-sm mb-2"><strong>Ціна:</strong> {{ number_format($tour->price, 2) }} ₴</p>
                            <a href="{{ route('show', $tour) }}" class="inline-block mt-3 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm">Детальніше</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Останні статті --}}
        <section class="max-w-7xl mx-auto px-6 py-16">
            <h2 class="text-2xl font-semibold mb-6">Останні статті</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($posts as $post)
                    <div class="bg-white rounded-lg shadow hover:shadow-md overflow-hidden transition">
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-5">
                            <h3 class="text-xl font-bold mb-2">{{ $post->title }}</h3>
                            <p class="text-gray-500 text-xs mb-2">{{ $post->created_at->format('d.m.Y') }}</p>
                            <p class="text-gray-600 text-sm mb-3">{{ Str::limit(strip_tags($post->content), 100) }}</p>
                            <a href="{{ route('public.posts.show', $post->slug) }}" class="text-blue-500 hover:underline text-sm">Читати далі</a>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Постів поки що немає.</p>
                @endforelse
            </div>
        </section>

    </div>
@endsection
