@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Створити новий тур</h1>
        @include('admin.form', ['tour' => null, 'cities' => $cities, 'categories' => $categories, 'tags' => $tags])

    </div>
@endsection
