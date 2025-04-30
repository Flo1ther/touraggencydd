@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-10 px-6">
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('tours.index') }}" class="text-gray-600 hover:text-blue-600">← Назад до списку</a>
            <h1 class="text-2xl font-bold text-blue-700">Створити тур</h1>
        </div>

        <form action="{{ route('tours.store') }}" method="POST" enctype="multipart/form-data"
              class="bg-white shadow-md rounded-lg p-6 space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700 font-medium">Назва</label>
                <input type="text" name="title" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Опис</label>
                <textarea name="description" rows="4" class="w-full border rounded px-3 py-2" required></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium">Ціна</label>
                    <input type="number" step="0.01" name="price" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Готель</label>
                    <input type="text" name="hotel" class="w-full border rounded px-3 py-2">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium">Дата початку</label>
                    <input type="date" name="start_date" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Дата завершення</label>
                    <input type="date" name="end_date" class="w-full border rounded px-3 py-2" required>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium">Тривалість (днів)</label>
                    <input type="number" name="duration_days" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Дорослих</label>
                    <input type="number" name="adults" min="1" value="1" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Дітей</label>
                    <input type="number" name="children" min="0" value="0" class="w-full border rounded px-3 py-2" required>
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Локація</label>
                <input type="text" name="location" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium">Транспорт</label>
                    <select name="transport" class="w-full border rounded px-3 py-2">
                        <option value="">-- Обрати --</option>
                        <option value="bus">Автобус</option>
                        <option value="plane">Літак</option>
                        <option value="train">Поїзд</option>
                        <option value="own">Власний</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Рейтинг</label>
                    <input type="number" name="rating" step="0.01" max="5" class="w-full border rounded px-3 py-2">
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Сервіси (JSON)</label>
                <textarea name="services" rows="3" class="w-full border rounded px-3 py-2"
                          placeholder='["wifi", "parking"]'></textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Фото туру</label>
                <input type="file" name="images[]" class="w-full border rounded px-3 py-2" multiple>
                <p class="text-xs text-gray-500 mt-1">Можна вибрати кілька файлів</p>
            </div>

            <div class="text-right pt-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                    Зберегти
                </button>
            </div>
        </form>
    </div>
@endsection
