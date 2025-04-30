@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto py-10 px-6 bg-white shadow-md rounded-xl">
        <h2 class="text-2xl font-semibold text-blue-600 mb-6">Редагувати користувача</h2>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Ім’я</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Роль</label>
                <input type="text" name="role" id="role" value="{{ old('role', $user->role) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="flex justify-end gap-4">
                <a href="{{ route('admin.users.index') }}"
                   class="inline-block px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md">Назад</a>

                <button type="submit"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">
                    Оновити
                </button>
            </div>
        </form>
    </div>
@endsection

