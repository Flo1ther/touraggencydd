<form method="POST" action="{{ isset($tour) ? route('tours.update', $tour->id) : route('tours.store') }}">
    @csrf
    @if(isset($tour))
        @method('PUT')
    @endif

    <div class="mb-4">
        <label for="title" class="block text-gray-700">Назва туру:</label>
        <input type="text" name="title" id="title" value="{{ old('title', $tour->title ?? '') }}" class="w-full p-2 border rounded">
    </div>

    <div class="mb-4">
        <label for="description" class="block text-gray-700">Опис:</label>
        <textarea name="description" id="description" class="w-full p-2 border rounded">{{ old('description', $tour->description ?? '') }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">
        {{ isset($tour) ? 'Оновити тур' : 'Створити тур' }}
    </button>
</form>
