<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-5 border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm leading-6 text-emerald-900">
        Asesi yang belum memiliki akun dapat registrasi lebih dulu, lalu masuk untuk melanjutkan proses sertifikasi.
    </div>

    <a href="{{ route('google.redirect') }}"
       class="mb-5 flex w-full items-center justify-center border border-stone-300 bg-white px-4 py-3 text-sm font-semibold text-stone-900 shadow-sm transition hover:bg-stone-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-offset-2">
        Login dengan Google
    </a>

    <div class="mb-5 flex items-center gap-3">
        <div class="h-px flex-1 bg-stone-200"></div>
        <span class="text-xs font-semibold uppercase tracking-[0.24em] text-stone-500">atau</span>
        <div class="h-px flex-1 bg-stone-200"></div>
    </div>

    <form method="POST" action="{{ route('login') }}" x-data="{ showPassword: false }" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="mt-1 block w-full"
                            x-bind:type="showPassword ? 'text' : 'password'"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between gap-3 pt-1">
            <label for="show_password" class="inline-flex items-center text-sm text-stone-700">
                <input id="show_password" type="checkbox" x-model="showPassword" class="rounded border-stone-300 text-green-700 shadow-sm focus:ring-green-600">
                <span class="ms-2">Tampilkan sandi</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-medium text-[#1f5a37] underline transition hover:text-[#123829] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700" href="{{ route('password.request') }}">
                    Lupa sandi?
                </a>
            @endif
        </div>

        <div class="space-y-4 pt-2">
            <x-primary-button class="w-full justify-center !rounded-none !bg-[#1f7a3b] !px-4 !py-3 !text-sm !font-semibold !shadow-lg !shadow-emerald-900/10 hover:!bg-[#195f2f] focus:!bg-[#195f2f] active:!bg-[#154d26]">
                Masuk
            </x-primary-button>

            @if (Route::has('register'))
                <p class="text-center text-sm text-stone-600">
                    Belum punya akun?
                    <a class="font-semibold text-[#1f5a37] underline transition hover:text-[#123829] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700" href="{{ route('register') }}">
                        Daftar asesi
                    </a>
                </p>
            @endif
        </div>
    </form>
</x-guest-layout>
