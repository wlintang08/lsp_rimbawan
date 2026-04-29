<x-guest-layout>
    <div class="mb-5 border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm leading-6 text-emerald-900">
        Form ini khusus pendaftaran akun asesi. Setelah registrasi, silakan verifikasi email sebelum masuk ke dashboard.
    </div>

    <a href="{{ route('google.redirect') }}"
       class="mb-5 flex w-full items-center justify-center border border-stone-300 bg-white px-4 py-3 text-sm font-semibold text-stone-900 shadow-sm transition hover:bg-stone-50 focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-offset-2">
        Daftar dengan Google
    </a>

    <div class="mb-5 flex items-center gap-3">
        <div class="h-px flex-1 bg-stone-200"></div>
        <span class="text-xs font-semibold uppercase tracking-[0.24em] text-stone-500">atau</span>
        <div class="h-px flex-1 bg-stone-200"></div>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="mt-1 block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <p class="mt-2 text-xs leading-6 text-stone-500">Email wajib menggunakan alamat Gmail.</p>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="mt-1 block w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <p class="mt-2 text-xs leading-6 text-stone-500">Minimal 8 karakter, berisi huruf besar, huruf kecil, angka, dan tanda khusus.</p>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="mt-1 block w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col gap-4 pt-2 sm:flex-row sm:items-center sm:justify-between">
            <a class="text-sm font-medium text-[#1f5a37] underline transition hover:text-[#123829] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700" href="{{ route('login') }}">
                Sudah punya akun? Masuk
            </a>

            <x-primary-button class="justify-center !rounded-none !bg-[#1f7a3b] !px-5 !py-3 !text-sm !font-semibold !shadow-lg !shadow-emerald-900/10 hover:!bg-[#195f2f] focus:!bg-[#195f2f] active:!bg-[#154d26]">
                Daftar Asesi
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
