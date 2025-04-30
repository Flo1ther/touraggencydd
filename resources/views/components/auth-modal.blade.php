<div id="auth-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-md relative shadow-lg">
        <button
            class="absolute top-2 right-2 text-gray-500 hover:text-gray-700"
            onclick="document.getElementById('auth-modal').classList.add('hidden')"
        >
            ✕
        </button>

        <h2 class="text-xl font-bold mb-4 text-center">Авторизація</h2>

        {{-- Вкладки входу та реєстрації --}}
        <div class="flex justify-center mb-4 space-x-4">
            <button onclick="showTab('login')" class="text-blue-600 font-semibold">Вхід</button>
            <button onclick="showTab('register')" class="text-gray-600 hover:text-blue-600">Реєстрація</button>
        </div>

        {{-- Форма входу --}}
        <form method="POST" action="{{ route('login') }}" id="login-tab">
            @csrf
            <div class="mb-4">
                <input type="email" name="email" class="form-control w-full border rounded p-2" placeholder="Email" required>
            </div>
            <div class="mb-4">
                <input type="password" name="password" class="form-control w-full border rounded p-2" placeholder="Пароль" required>
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full">Увійти</button>
        </form>

        {{-- Форма реєстрації --}}
        <form method="POST" action="{{ route('register') }}" id="register-tab" class="hidden">
            @csrf
            <div class="mb-4">
                <input type="text" name="name" class="form-control w-full border rounded p-2" placeholder="Ім'я" required>
            </div>
            <div class="mb-4">
                <input type="email" name="email" class="form-control w-full border rounded p-2" placeholder="Email" required>
            </div>
            <div class="mb-4">
                <input type="password" name="password" class="form-control w-full border rounded p-2" placeholder="Пароль" required>
            </div>
            <div class="mb-4">
                <input type="password" name="password_confirmation" class="form-control w-full border rounded p-2" placeholder="Підтвердження пароля" required>
            </div>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded w-full">Зареєструватися</button>
        </form>
    </div>
</div>

<script>
    function showTab(tab) {
        document.getElementById('login-tab').classList.add('hidden');
        document.getElementById('register-tab').classList.add('hidden');
        document.getElementById(tab + '-tab').classList.remove('hidden');
    }
</script>
