@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Доступні тури</h1>
        <div class="row">
            @foreach ($tours as $tour)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($tour->images->first())
                            <img src="{{ asset('storage/' . $tour->images->first()->image_path) }}" class="card-img-top" alt="Зображення туру">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $tour->title }}</h5>
                            <p class="card-text">{{ Str::limit($tour->description, 100) }}</p>
                            <p class="text-muted">📍 {{ $tour->location }}</p>
                            <p><strong>💰 Ціна:</strong> {{ $tour->price }} грн</p>
                            <p><strong>📅 Дати:</strong> {{ $tour->start_date }} — {{ $tour->end_date }}</p>
                            <a href="#" class="btn btn-primary">Детальніше</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $tours->links() }}
        </div>
    </div>
@endsection
