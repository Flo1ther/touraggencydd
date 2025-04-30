@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-10 px-6">
        <h1 class="text-3xl font-bold mb-6 text-red-600">Бронювання</h1>

        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full table-auto text-sm">
                <thead class="bg-gray-100">
                <tr class="text-left">
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Користувач</th>
                    <th class="px-4 py-2">Тур</th>
                    <th class="px-4 py-2">Дата</th>
                    <th class="px-4 py-2">Статус</th>
                    <th class="px-4 py-2">Дії</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($bookings as $booking)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td>
                            {{ $booking->user?->name ?? $booking->name ?? 'Невідомий користувач' }}<br>
                            <small>{{ $booking->user?->email ?? $booking->email }}</small>
                        </td>

                        <td class="px-4 py-2">{{ $booking->tour->title }}</td>
                        <td class="px-4 py-2">{{ $booking->created_at->format('d.m.Y') }}</td>
                        <td class="px-4 py-2">{{ $booking->status }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.bookings.show', $booking) }}" class="text-blue-500 hover:underline">Деталі</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-500">Бронювань поки немає.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="inline-block mb-4 text-blue-600 hover:underline">
            &larr; Назад
        </a>

    </div>
@endsection
