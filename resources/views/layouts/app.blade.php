<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LSP Rimbawan</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">LSP Rimbawan & Lingkungan</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">

                @auth

                    {{-- ADMIN --}}
                    @if(auth()->user()->role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('asesi.index') }}">Asesi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('asesor.index') }}">Asesor</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('skema.index') }}">Skema</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.pendaftaran') }}">Pendaftaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.audit') }}">Audit Log</a>
                        </li>
                    @endif

                    {{-- ASESOR --}}
                    @if(auth()->user()->role == 'asesor')
                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('asesor.dashboard') }}">Dashboard</a>
                        </li>
                    @endif

                    {{-- ASESI --}}
                    @if(auth()->user()->role == 'asesi')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('asesi.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('asesi.skema') }}">Skema</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('asesi.pendaftaran') }}">Pendaftaran Saya</a>
                        </li>
                    @endif

                @endauth

            </ul>

            <!-- RIGHT NAV -->
            <ul class="navbar-nav align-items-center">

                @auth

                    {{-- 🔔 NOTIFIKASI ASESI --}}
                    @if(auth()->user()->role == 'asesi')
                        @php
                            $notifCount = \App\Models\Pendaftaran::where('user_id', auth()->id())
                                ->whereNotNull('notifikasi')
                                ->where('is_read', false)
                                ->count();

                            $notifList = \App\Models\Pendaftaran::where('user_id', auth()->id())
                                ->whereNotNull('notifikasi')
                                ->latest()
                                ->take(5)
                                ->get();
                        @endphp

                        <li class="nav-item dropdown me-2">
                            <a class="nav-link position-relative" href="#" data-bs-toggle="dropdown">
                                🔔
                                @if($notifCount > 0)
                                    <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                                        {{ $notifCount }}
                                    </span>
                                @endif
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li class="dropdown-header">Notifikasi</li>

                                @forelse($notifList as $n)
                                    <li>
                                        <span class="dropdown-item small">
                                            {{ $n->notifikasi }}
                                        </span>
                                    </li>
                                @empty
                                    <li>
                                        <span class="dropdown-item text-muted">
                                            Tidak ada notifikasi
                                        </span>
                                    </li>
                                @endforelse
                            </ul>
                        </li>
                    @endif

                        {{-- BADGE SUPERADMIN --}}
                    @if(auth()->user()->role == 'superadmin')
                        <li class="nav-item">
                            <span class="badge bg-warning text-dark me-2">
                             SUPERADMIN
                            </span>
                        </li>
                    @endif

                    {{-- USER --}}
                    <li class="nav-item">
                        <span class="nav-link text-white">
                            {{ auth()->user()->name }}
                        </span>
                    </li>

                    {{-- LOGOUT --}}
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-danger btn-sm">Logout</button>
                        </form>
                    </li>

                @endauth

            </ul>
        </div>
    </div>
</nav>

<!-- CONTENT -->
<div class="container mt-4">
    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- 🔔 AUTO MARK AS READ -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    const notif = document.querySelector('[data-bs-toggle="dropdown"]');

    if (notif) {
        notif.addEventListener('click', function () {

            fetch("{{ route('notifikasi.read') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                }
            });

        });
    }

});
</script>

</body>
</html>