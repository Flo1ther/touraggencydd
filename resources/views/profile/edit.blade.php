@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto py-10">
        <h1 class="text-2xl font-bold mb-4">Профіль</h1>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label>Імʼя</label>
                <input name="name" value="{{ old('name', $user->name) }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label>Email</label>
                <input name="email" value="{{ old('email', $user->email) }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label>Аватар</label>
                @if ($user->profile_picture)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" class="h-20 w-20 rounded-full object-cover">
                    </div>
                @endif
                <input type="file" name="profile_picture" class="w-full border p-2 rounded">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Оновити</button>
        </form>
    </div>
@endsection
