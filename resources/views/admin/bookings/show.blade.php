@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Деталі бронювання</h1>
            <a href="{{ route('admin.bookings.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded">
                ⬅ Назад до списку
            </a>
        </div>

        <div class="bg-white shadow rounded p-6 space-y-3">
            <p><strong>ID:</strong> {{ $booking->id }}</p>
            <p><strong>Користувач:</strong> {{ $booking->user?->name ?? 'Невідомо' }}</p>
            <p><strong>Тур:</strong> {{ $booking->tour?->title ?? 'Невідомо' }}</p>
            <p><strong>Ім’я:</strong> {{ $booking->name }}</p>
            <p><strong>Email:</strong> {{ $booking->email }}</p>
            <p><strong>Дорослих:</strong> {{ $booking->adults }}</p>
            <p><strong>Дітей:</strong> {{ $booking->children }}</p>
            <p><strong>Дата створення:</strong> {{ $booking->created_at->format('d.m.Y H:i') }}</p>
        </div>

        <div class="mt-6">
            <a href="{{ route('admin.bookings.edit', $booking) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                ✏ Редагувати
            </a>
        </div>
    </div>
@endsection
