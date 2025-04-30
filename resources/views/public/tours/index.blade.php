@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-8">Наші тури</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
            @foreach ($tours as $tour)
                @php
                    $imagePath = $tour->images->first()->image_path ?? null;
                    $imageSrc = $imagePath ? asset('storage/' . $imagePath) : asset('storage/images/placeholder.jpg');
                @endphp

                <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                    <img src="{{ $imageSrc }}" alt="{{ $tour->name }}" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <h3 class="text-lg font-bold mb-2">{{ $tour->name }}</h3>
                        <p class="text-gray-600 text-sm mb-3">{{ Str::limit($tour->description, 100) }}</p>
                        <p class="text-gray-800 text-sm mb-2"><strong>Ціна:</strong> {{ number_format($tour->price, 2) }} ₴</p>
                        <a href="{{ route('show', $tour->id) }}" class="inline-block mt-3 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm">
                            Детальніше
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center">
            <a href="{{ route('home') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                ← Назад на головну
            </a>
        </div>
    </div>
@endsection
