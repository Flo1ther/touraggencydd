@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Редагувати тур</h1>

        @include('tours.form', [
            'tour' => $tour,
            'route' => route('tours.update', $tour),
            'method' => 'PUT'
        ])

        <hr>
        <h3>Фото туру</h3>
        <div class="row">
            @foreach ($tour->images as $image)
                <div class="col-md-3 mb-3">
                    <img src="{{ asset('storage/' . $image->image_path) }}" class="img-fluid rounded mb-1">

                    <form action="{{ route('tour-images.destroy', $image) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити це фото?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger w-100">🗑 Видалити</button>
                    </form>
                </div>
            @endforeach
        </div>

    </div>
@endsection
