@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-6">Редагувати бронювання</h1>

        <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block font-semibold">Ім’я</label>
                <input type="text" id="name" name="name" value="{{ old('name', $booking->name) }}"
                       class="w-full border rounded p-2" required>
            </div>

            <div>
                <label for="email" class="block font-semibold">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $booking->email) }}"
                       class="w-full border rounded p-2" required>
            </div>

            <div>
                <label for="adults" class="block font-semibold">Дорослі</label>
                <input type="number" id="adults" name="adults" value="{{ old('adults', $booking->adults) }}"
                       class="w-full border rounded p-2" min="1" required>
            </div>

            <div>
                <label for="children" class="block font-semibold">Діти</label>
                <input type="number" id="children" name="children" value="{{ old('children', $booking->children) }}"
                       class="w-full border rounded p-2" min="0">
            </div>

            <div>
                <label for="status" class="block font-semibold">Статус</label>
                <select id="status" name="status" class="w-full border rounded p-2">
                    <option value="очікує" {{ $booking->status === 'очікує' ? 'selected' : '' }}>Очікує</option>
                    <option value="підтверджено" {{ $booking->status === 'підтверджено' ? 'selected' : '' }}>Підтверджено</option>
                    <option value="скасовано" {{ $booking->status === 'скасовано' ? 'selected' : '' }}>Скасовано</option>
                </select>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('admin.bookings.index') }}" class="text-gray-600 hover:underline">⬅ Назад</a>
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded">
                    💾 Зберегти
                </button>
            </div>
        </form>
    </div>
@endsection
