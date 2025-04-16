<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Список турів') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('tours.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">+ Додати тур</a>

        @foreach ($tours as $tour)
            <div class="bg-white shadow-md rounded p-4 mb-4">
                <div class="flex">
                    <div class="w-1/3">
                        @if($tour->images->first())
                            <img src="{{ asset('storage/' . $tour->images->first()->image_path) }}" class="rounded w-full h-auto" alt="Фото туру">
                        @else
                            <img src="https://via.placeholder.com/300x200?text=No+Image" class="rounded w-full h-auto" alt="Без фото">
                        @endif
                    </div>
                    <div class="w-2/3 pl-4">
                        <h3 class="text-xl font-semibold">{{ $tour->title }}</h3>
                        <p class="text-gray-700">{{ $tour->description }}</p>
                        <a href="{{ route('tours.edit', $tour) }}" class="mt-2 inline-block bg-indigo-500 hover:bg-indigo-600 text-white py-1 px-3 rounded">Редагувати</a>
                    </div>
                </div>
            </div>
        @endforeach

        {{ $tours->links() }}
    </div>
</x-app-layout>
