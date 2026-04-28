<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class GoogleAuthController extends Controller
{
    public function redirect(): RedirectResponse
    {
        if (! $this->googleIsConfigured()) {
            return redirect()->route('login')->withErrors([
                'email' => 'Konfigurasi Google Login belum diisi.',
            ]);
        }

        return Socialite::driver('google')->redirect();
    }

    public function callback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (Throwable) {
            return redirect()->route('login')->withErrors([
                'email' => 'Login Google gagal. Silakan coba lagi.',
            ]);
        }

        if (! $googleUser->getEmail()) {
            return redirect()->route('login')->withErrors([
                'email' => 'Akun Google tidak memberikan alamat email.',
            ]);
        }

        $user = User::where('google_id', $googleUser->getId())
            ->orWhere('email', $googleUser->getEmail())
            ->first();

        if ($user) {
            $user->forceFill([
                'google_id' => $googleUser->getId(),
                'email_verified_at' => $user->email_verified_at ?? now(),
            ])->save();
        } else {
            $user = User::create([
                'name' => $googleUser->getName() ?: $googleUser->getNickname() ?: 'Asesi',
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'password' => Hash::make(Str::random(40)),
                'role' => 'asesi',
                'email_verified_at' => now(),
            ]);
        }

        Auth::login($user, remember: true);

        return redirect()->intended($this->redirectPath($user));
    }

    private function redirectPath(User $user): string
    {
        return match ($user->role) {
            'asesi' => '/asesi-user',
            default => '/dashboard',
        };
    }

    private function googleIsConfigured(): bool
    {
        return filled(config('services.google.client_id'))
            && filled(config('services.google.client_secret'))
            && filled(config('services.google.redirect'));
    }
}
