@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Додати тур</h1>

        @include('tours.form', ['tour' => new \App\Models\Tour(), 'route' => route('tours.store'), 'method' => 'POST'])

    </div>
@endsection
