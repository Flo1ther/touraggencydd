<form action="{{ $route }}" method="POST" enctype="multipart/form-data">

@csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    <div class="mb-3">
        <label class="form-label">Назва туру</label>
        <input type="text" name="title" value="{{ old('title', $tour->title) }}" class="form-control" required>
    </div>

    <div>
        <label for="images">Фото туру:</label>
        <input type="file" name="images[]" multiple>
    </div>

    <div class="mb-3">
        <label class="form-label">Опис</label>
        <textarea name="description" class="form-control" rows="4" required>{{ old('description', $tour->description) }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Ціна</label>
        <input type="number" step="0.01" name="price" value="{{ old('price', $tour->price) }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Дата початку</label>
        <input type="date" name="start_date" value="{{ old('start_date', $tour->start_date) }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Дата завершення</label>
        <input type="date" name="end_date" value="{{ old('end_date', $tour->end_date) }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Місце</label>
        <input type="text" name="location" value="{{ old('location', $tour->location) }}" class="form-control" required>
    </div>

    <button class="btn btn-success">Зберегти</button>
    <a href="{{ route('tours.index') }}" class="btn btn-secondary">Назад</a>
</form>
