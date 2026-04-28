<x-guest-layout>
    <div class="mb-4 rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
        Form ini khusus pendaftaran akun asesi. Setelah registrasi, silakan verifikasi email sebelum masuk ke dashboard asesi.
    </div>

    <a href="{{ route('google.redirect') }}"
       class="mb-4 flex w-full items-center justify-center rounded-md border border-black/40 bg-white px-4 py-2 text-sm font-semibold text-black shadow-sm transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-offset-2">
        Daftar dengan Google
    </a>

    <div class="mb-4 flex items-center gap-3">
        <div class="h-px flex-1 bg-gray-200"></div>
        <span class="text-xs font-semibold uppercase tracking-wide text-black">atau</span>
        <div class="h-px flex-1 bg-gray-200"></div>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <p class="mt-1 text-xs text-black">Email wajib menggunakan alamat Gmail.</p>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <p class="mt-1 text-xs text-black">Minimal 8 karakter, berisi huruf besar, huruf kecil, angka, dan tanda khusus.</p>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-black hover:text-green-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700" href="{{ route('login') }}">
                Sudah punya akun? Masuk
            </a>

            <x-primary-button class="ms-4">
                Daftar Asesi
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
