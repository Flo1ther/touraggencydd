@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <div class="bg-white rounded-2xl shadow-lg p-8 space-y-6">
            {{-- Назва туру --}}
            <h1 class="text-4xl font-extrabold text-gray-800">{{ $tour->title }}</h1>

            {{-- Фото туру --}}
            @if($tour->images && $tour->images->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($tour->images as $image)
                        <img src="{{ asset('storage/' . $image->image_path) }}"
                             alt="Фото туру"
                             class="rounded-xl shadow-md object-cover h-64 w-full">
                    @endforeach
                </div>
            @endif

            {{-- Опис --}}
            <div class="text-gray-600 text-lg leading-relaxed">
                {{ $tour->description }}
            </div>

            {{-- Інфо --}}
            @php
                $startDate = \Carbon\Carbon::parse($tour->start_date)->format('Y-m-d');
                $endDate = \Carbon\Carbon::parse($tour->end_date)->format('Y-m-d');
                $transports = ['bus' => 'Автобус', 'plane' => 'Літак', 'train' => 'Потяг', 'own' => 'Самостійно'];
                $services = json_decode($tour->services, true) ?? [];
                $rating = round($tour->rating ?? 5);
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700 text-base">
                <div><strong>Ціна:</strong> {{ number_format($tour->price, 2) }} грн</div>
                <div><strong>Тривалість:</strong> {{ $tour->duration_days ?? '—' }} днів</div>
                <div><strong>Дати:</strong> {{ $startDate }} – {{ $endDate }}</div>
                <div><strong>Дорослі:</strong> {{ $tour->adults ?? 1 }} | <strong>Діти:</strong> {{ $tour->children ?? 0 }}</div>
                <div><strong>Локація:</strong> {{ $tour->location ?? '—' }}</div>
                <div><strong>Готель:</strong> {{ $tour->hotel ?? '—' }}</div>
                <div><strong>Транспорт:</strong> {{ $transports[$tour->transport] ?? 'Не вказано' }}</div>
                <div>
                    <strong>Рейтинг:</strong>
                    <span class="text-yellow-400 text-xl">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $rating)
                                ★
                            @else
                                ☆
                            @endif
                        @endfor
                    </span>
                </div>
                <div class="col-span-1 md:col-span-2">
                    <strong>Послуги:</strong>
                    @if (count($services))
                        <ul class="list-disc list-inside mt-1 text-gray-600">
                            @foreach($services as $service)
                                <li>{{ ucfirst($service) }}</li>
                            @endforeach
                        </ul>
                    @else
                        <span class="text-gray-500">—</span>
                    @endif
                </div>
            </div>

            {{-- Кнопка "Забронювати" --}}
            <div class="text-center mt-8">
                <button onclick="toggleModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg transition duration-300">
                    Забронювати тур
                </button>
            </div>

            {{-- Модальне вікно --}}
            <div id="bookingModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
                <div class="bg-white rounded-2xl p-6 w-full max-w-lg shadow-xl relative">
                    <button onclick="toggleModal()" class="absolute top-3 right-4 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>

                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Бронювання туру</h2>

                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-xl">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('bookings.store', $tour) }}" class="space-y-4 mt-4">
                        @csrf

                        <input name="name" placeholder="Ім’я" value="{{ old('name', auth()->user()?->name) }}"
                               required class="w-full border p-2 rounded">
                        <input name="email" type="email" placeholder="Email" value="{{ old('email', auth()->user()?->email) }}"
                               required class="w-full border p-2 rounded">
                        <input name="phone" type="text" placeholder="Телефон"
                               value="{{ old('phone') }}" required class="w-full border p-2 rounded">
                        <input name="adults" type="number" min="1" value="1"
                               required placeholder="Дорослі" class="w-full border p-2 rounded">
                        <input name="children" type="number" min="0" value="0"
                               placeholder="Діти" class="w-full border p-2 rounded">
                        <textarea name="notes" placeholder="Побажання"
                                  class="w-full border p-2 rounded">{{ old('notes') }}</textarea>

                        <button type="submit"
                                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 w-full">
                            Забронювати
                        </button>
                    </form>
                </div>
            </div>

            {{-- Відгуки --}}
            <div class="mt-10">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Відгуки</h2>

                @auth
                    <form method="POST" action="{{ route('tours.reviews.store', $tour) }}" class="mb-6 space-y-4">
                        @csrf

                        <div class="star-rating flex flex-row-reverse justify-end gap-1 text-2xl">
                            @for ($i = 5; $i >= 1; $i--)
                                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="hidden"
                                       @if(old('rating') == $i) checked @endif>
                                <label for="star{{ $i }}" class="cursor-pointer text-gray-300 hover:text-yellow-400 transition-all">
                                    ★
                                </label>
                            @endfor
                        </div>

                        @error('rating')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror

                        <textarea name="comment" class="w-full border p-2 rounded" rows="3" placeholder="Залиште свій відгук..."></textarea>

                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                            Надіслати відгук
                        </button>
                    </form>
                @endauth

                @if ($tour->reviews->count())
                    <div class="space-y-4">
                        @foreach ($tour->reviews as $review)
                            <div class="bg-gray-100 p-4 rounded-xl">
                                <div class="flex justify-between items-center">
                                    <strong>{{ $review->user->name }}</strong>
                                    <div class="text-yellow-400">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->rating)
                                                ★
                                            @else
                                                ☆
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <p class="mt-2 text-gray-700">{{ $review->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600">Ще немає відгуків.</p>
                @endif
            </div>

            {{-- Повідомлення про успішне бронювання --}}
            @if(session('success'))
                <div class="mt-4 p-4 bg-green-100 text-green-800 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Кнопка назад --}}
            <a href="{{ route('index') }}" class="inline-block text-blue-600 hover:text-blue-800 font-medium transition duration-300">
                &larr; Назад до турів
            </a>
        </div>
    </div>
@endsection

<style>
    .star-rating input:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #facc15 !important;
    }
</style>

<script>
    function toggleModal() {
        const modal = document.getElementById('bookingModal');
        modal.classList.toggle('hidden');
        modal.classList.toggle('flex');
    }
</script>
