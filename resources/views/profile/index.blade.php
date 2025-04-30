@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto py-10 px-6">
        <div class="bg-white p-8 rounded-xl shadow-md">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-green-700">Мій профіль</h1>
                <a href="{{ route('home') }}" class="text-sm text-blue-600 hover:underline">&larr; Назад</a>
            </div>

            <div class="flex items-center gap-6 mb-8">
                @if($user->profile_picture)
                    <img src="{{ Storage::url($user->profile_picture) }}" alt="Аватар" class="w-32 h-32 rounded-full object-cover shadow">
                @else
                    <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-xl">
                        Н/Д
                    </div>
                @endif

                <div>
                    <p class="text-lg"><strong>Ім’я:</strong> {{ $user->name }}</p>
                    <p class="text-lg"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="text-lg"><strong>Дата реєстрації:</strong> {{ $user->created_at->format('d.m.Y') }}</p>

                    <a href="{{ route('profile.edit') }}" class="mt-3 inline-block text-blue-600 hover:underline">Редагувати профіль</a>

                    @if($user->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="mt-3 ml-4 inline-block text-white bg-green-600 px-4 py-2 rounded hover:bg-green-700">
                            Керувати
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="bg-white mt-10 p-8 rounded-xl shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Мої бронювання</h2>

            @forelse ($bookings as $booking)
                <div class="border border-gray-200 p-4 rounded-lg shadow-sm mb-4 bg-gray-50 flex justify-between items-start">
                    <div>
                        <p><strong>Тур:</strong> {{ $booking->tour->title ?? 'Видалено' }}</p>
                        <p><strong>Дата бронювання:</strong> {{ $booking->created_at->format('d.m.Y') }}</p>
                        <p><strong>Статус:</strong> {{ ucfirst($booking->status ?? 'активне') }}</p>
                    </div>
                    <form method="POST" action="{{ route('bookings.cancel', $booking) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Скасувати</button>
                    </form>
                </div>
            @empty
                <p class="text-gray-500">У вас немає активних бронювань.</p>
            @endforelse
        </div>
    </div>
@endsection
