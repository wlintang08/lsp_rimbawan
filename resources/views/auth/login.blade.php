<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-4 rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
        Asesi yang belum memiliki akun wajib melakukan registrasi terlebih dahulu.
    </div>

    <a href="{{ route('google.redirect') }}"
       class="mb-4 flex w-full items-center justify-center rounded-md border border-black/40 bg-white px-4 py-2 text-sm font-semibold text-black shadow-sm transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-offset-2">
        Login dengan Google
    </a>

    <div class="mb-4 flex items-center gap-3">
        <div class="h-px flex-1 bg-gray-200"></div>
        <span class="text-xs font-semibold uppercase tracking-wide text-black">atau</span>
        <div class="h-px flex-1 bg-gray-200"></div>
    </div>

    <form method="POST" action="{{ route('login') }}" x-data="{ showPassword: false }">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            x-bind:type="showPassword ? 'text' : 'password'"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Show Password -->
        <div class="block mt-4">
            <label for="show_password" class="inline-flex items-center">
                <input id="show_password" type="checkbox" x-model="showPassword" class="rounded border-gray-300 text-green-700 shadow-sm focus:ring-green-600">
                <span class="ms-2 text-sm text-black">Tampilkan sandi</span>
            </label>
        </div>

        <div class="mt-5 space-y-4">
            @if (Route::has('password.request'))
                <div class="text-right">
                    <a class="text-sm font-medium text-black underline hover:text-green-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700" href="{{ route('password.request') }}">
                        Lupa sandi?
                    </a>
                </div>
            @endif

            <x-primary-button class="w-full justify-center">
                Masuk
            </x-primary-button>

            @if (Route::has('register'))
                <p class="text-center text-sm text-black">
                    Belum punya akun?
                    <a class="font-semibold underline hover:text-green-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700" href="{{ route('register') }}">
                        Daftar asesi
                    </a>
                </p>
            @endif
        </div>
    </form>
</x-guest-layout>
