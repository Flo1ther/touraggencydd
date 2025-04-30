@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-10 px-6">
        <h1 class="text-3xl font-bold text-green-700 mb-6">Інформація про користувача</h1>

        <div class="bg-white shadow rounded-xl p-6 space-y-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Ім’я</h2>
                <p class="text-gray-900">{{ $user->name }}</p>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-gray-700">Email</h2>
                <p class="text-gray-900">{{ $user->email }}</p>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-gray-700">Роль</h2>
                <p class="text-gray-900">{{ $user->role ?? '—' }}</p>
            </div>

            <div class="mt-6 flex space-x-4">
                <a href="{{ route('users.edit', $user) }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg">
                    Редагувати
                </a>
                <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити цього користувача?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg">
                        Видалити
                    </button>
                </form>
                <a href="{{ route('users.index') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg">
                    Назад до списку
                </a>
            </div>
        </div>
    </div>
@endsection
