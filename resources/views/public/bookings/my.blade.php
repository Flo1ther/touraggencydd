@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-10 px-6">
        <h1 class="text-2xl font-bold mb-4">Мої бронювання</h1>

        @forelse($bookings as $booking)
            <div class="bg-white p-4 shadow rounded mb-4">
                <p><strong>Тур:</strong> {{ $booking->tour->title }}</p>
                <p><strong>Дата:</strong> {{ $booking->created_at->format('d.m.Y') }}</p>
                <p><strong>Телефон:</strong> {{ $booking->phone }}</p>
                <p><strong>Побажання:</strong> {{ $booking->notes ?? '—' }}</p>
            </div>
        @empty
            <p class="text-gray-500">Бронювань не знайдено.</p>
        @endforelse
    </div>
@endsection
