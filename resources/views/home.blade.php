<x-layouts.app>

@section('content')
    <div class="container">

        <h1 class="mb-4">Подорожуй з усмішкою 😄</h1>
        <div class="mb-5 bg-cover bg-center rounded-lg shadow-md p-5 text-white" style="background-image: url('{{ asset('images/header.jpg') }}'); min-height: 300px;">
            <div class="bg-black bg-opacity-50 p-5 rounded">
                <h1 class="text-3xl font-bold mb-2">Ласкаво просимо на "Подорожуй з усмішкою!" 😊</h1>
                <p class="text-lg">Відкрий світ разом із нами — найкращі тури, незабутні враження!</p>
                <a href="{{ route('tours.index') }}" class="mt-3 inline-block bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-4 py-2 rounded transition">Обрати тур</a>
            </div>
        </div>

        <h2>Останні тури</h2>
        <div class="row mb-5">
            <pre>{{ dd($tours) }}</pre>
            @foreach ($tours as $tour)
                <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                    <h3>{{ $tour->title }}</h3>
                    <p><strong>Опис:</strong> {{ $tour->description }}</p>
                    <p><strong>Ціна:</strong> ${{ $tour->price }}</p>
                    <p><strong>Місце:</strong> {{ $tour->location }}</p>
                </div>
            @endforeach
        </div>

        <h2>Останні статті</h2>
        <div class="row">
            @forelse($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                            <a href="#" class="btn btn-sm btn-outline-secondary">Читати</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>Постів ще немає.</p>
            @endforelse
        </div>

    </div>
</x-layouts.app>
