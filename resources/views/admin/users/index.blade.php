@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-10 px-6">
        <h1 class="text-3xl font-bold mb-6 text-green-700">Керування користувачами</h1>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow rounded-xl overflow-hidden">
                <thead class="bg-gray-100 text-gray-700 text-sm">
                <tr>
                    <th class="px-6 py-3 text-left">#</th>
                    <th class="px-6 py-3 text-left">Ім’я</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Роль</th>
                    <th class="px-6 py-3 text-left">Дії</th>
                </tr>
                </thead>
                <tbody class="text-sm text-gray-800">
                @forelse ($users as $user)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $user->id }}</td>
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">{{ $user->role ?? '—' }}</td>
                        <td class="px-6 py-4 flex gap-2">
                            <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:underline">Редагувати</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Видалити користувача?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Видалити</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Користувачів не знайдено.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <a href="{{ url()->previous() }}" class="inline-block mb-4 text-blue-600 hover:underline">
            &larr; Назад
        </a>

    </div>
@endsection
