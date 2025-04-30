@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto py-10">
        <h1 class="text-2xl font-bold mb-4">Реєстрація</h1>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name">Імʼя</label>
                <input id="name" name="name" type="text" required class="w-full border p-2 rounded" value="{{ old('name') }}">
            </div>

            <div>
                <label for="email">Email</label>
                <input id="email" name="email" type="email" required class="w-full border p-2 rounded" value="{{ old('email') }}">
            </div>

            <div>
                <label for="password">Пароль</label>
                <input id="password" name="password" type="password" required class="w-full border p-2 rounded">
            </div>

            <div>
                <label for="password_confirmation">Підтвердіть пароль</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required class="w-full border p-2 rounded">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Зареєструватися</button>
        </form>
    </div>
@endsection
