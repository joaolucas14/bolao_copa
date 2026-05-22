<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Bolão Innovate') }} — @yield('titulo', 'Copa do Mundo 2026')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><rect width='32' height='32' rx='6' fill='%23009C3B'/><path d='M16 3 L29 11 L29 21 L16 29 L3 21 L3 11 Z' fill='%23FEDF00'/><circle cx='16' cy='16' r='6' fill='%23002776'/></svg>" />

    <!-- Material Symbols -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        /* ===== RESPONSIVE NAV ===== */
        .nav-desktop { display: flex; gap: 4px; margin-left: 12px; }
        .nav-user-desktop { display: flex; align-items: center; gap: 10px; }
        .nav-hamburger { display: none; }
        .nav-mobile-drawer {
            display: none;
            position: fixed; inset: 0; top: 72px; z-index: 40;
            background: rgba(5,11,31,0.96); backdrop-filter: blur(18px);
            flex-direction: column; padding: 16px 20px 32px;
            border-top: 1px solid var(--border-soft);
        }
        .nav-mobile-drawer.aberto { display: flex; }

        @media (max-width: 768px) {
            .nav-desktop { display: none; }
            .nav-user-desktop { display: none; }
            .nav-hamburger { display: inline-flex; }
            .header-bolao-ativo { display: none !important; }
        }

        /* ===== TOAST ===== */
        #toast-container {
            position: fixed; bottom: 24px; right: 24px; z-index: 9999;
            display: flex; flex-direction: column; gap: 10px; align-items: flex-end;
            pointer-events: none;
        }
        .toast {
            display: inline-flex; align-items: center; gap: 12px;
            padding: 12px 18px; border-radius: var(--r-lg);
            background: var(--bg-elev-1); border: 1px solid var(--border-medium);
            box-shadow: 0 18px 50px rgba(0,0,0,0.60);
            font: 600 13.5px/1 Inter; color: #fff;
            animation: slideUp .25s var(--ease) both, fadeOut .4s var(--ease) 2.6s both;
            pointer-events: auto;
        }
        .toast.sucesso { border-color: rgba(31,214,107,0.45); }
        .toast.erro    { border-color: rgba(255,77,106,0.45); }
        @keyframes slideUp  { from { opacity:0; transform:translateY(16px); } to { opacity:1; transform:none; } }
        @keyframes fadeOut  { from { opacity:1; } to { opacity:0; pointer-events:none; } }

        /* ===== WIRE LOADING ===== */
        [wire\:loading] { opacity: .65; pointer-events: none; }
    </style>
</head>
<body style="background: var(--bg-base); min-height: 100vh;">

{{-- Decoração de fundo --}}
<div style="position: fixed; inset: 0; pointer-events: none; z-index: 0; overflow: hidden;">
    <svg width="100%" height="100%" viewBox="0 0 1440 900" preserveAspectRatio="xMidYMid slice">
        <defs>
            <linearGradient id="dia" x1="0" y1="0" x2="0" y2="1">
                <stop offset="0%" stop-color="#FEDF00" stop-opacity="0.06" />
                <stop offset="100%" stop-color="#FEDF00" stop-opacity="0.0" />
            </linearGradient>
            <radialGradient id="navyglow" cx="0.5" cy="0">
                <stop offset="0%" stop-color="#002776" stop-opacity="0.40" />
                <stop offset="100%" stop-color="#002776" stop-opacity="0" />
            </radialGradient>
        </defs>
        <rect x="0" y="0" width="1440" height="900" fill="url(#navyglow)" />
        <path d="M 720 90 L 1380 450 L 720 810 L 60 450 Z" stroke="url(#dia)" stroke-width="1.2" fill="none" />
        <path d="M 720 220 L 1240 450 L 720 680 L 200 450 Z" stroke="url(#dia)" stroke-width="0.8" fill="none" opacity=".5" />
    </svg>
</div>

{{-- Header --}}
<header style="
    position: relative; z-index: 10; height: 72px;
    display: flex; align-items: center; padding: 0 20px;
    border-bottom: 1px solid var(--border-soft);
    background: rgba(5,11,31,0.65); backdrop-filter: blur(14px);
    gap: 20px;
" x-data="{ menuAberto: false }">

    {{-- Brand --}}
    <a href="{{ route('dashboard') }}" style="display: flex; align-items: center; gap: 12px; text-decoration: none; flex-shrink: 0;">
        <svg width="44" height="40" viewBox="0 0 42 40" style="flex-shrink: 0;">
            <defs>
                <linearGradient id="flagG" x1="0" y1="0" x2="1" y2="1">
                    <stop offset="0%" stop-color="#1FD66B" />
                    <stop offset="100%" stop-color="#006B28" />
                </linearGradient>
            </defs>
            <rect x="2" y="3" width="2" height="34" rx="1" fill="#fff" opacity=".85" />
            <path d="M5 5 Q 18 1, 32 6 T 40 8 L 40 24 Q 27 28, 14 23 T 5 22 Z" fill="url(#flagG)" />
            <path d="M22.5 8 L 33 14 L 22.5 20 L 14 14 Z" fill="#FEDF00" />
            <circle cx="22.5" cy="14" r="3.3" fill="#002776" />
        </svg>
        <div style="width: 1px; height: 22px; background: var(--border-strong); margin-inline: 2px;"></div>
        <div style="display: flex; flex-direction: column; line-height: 1.05;">
            <span style="font: 700 13px/1 Inter; letter-spacing: .04em; text-transform: uppercase; color: #fff;">Bolão Innovate</span>
            <span style="font: 500 10.5px/1 Inter; color: var(--fg-muted); letter-spacing: .22em; margin-top: 4px; white-space: nowrap;">COPA 2026</span>
        </div>
    </a>

    {{-- Desktop nav --}}
    <nav class="nav-desktop">
        <a href="{{ route('dashboard') }}" style="
            display: inline-flex; align-items: center; gap: 8px;
            padding: 0 14px; height: 36px; border-radius: var(--r-pill);
            font: 500 13.5px/1 Inter; text-decoration: none;
            color: {{ request()->routeIs('dashboard') ? '#fff' : 'var(--fg-secondary)' }};
            background: {{ request()->routeIs('dashboard') ? 'rgba(255,255,255,0.08)' : 'transparent' }};
            border: {{ request()->routeIs('dashboard') ? '1px solid var(--border-medium)' : '1px solid transparent' }};
        ">
            <span class="material-symbols-outlined" style="font-size: 18px; color: {{ request()->routeIs('dashboard') ? 'var(--br-yellow)' : 'var(--fg-muted)' }};">dashboard</span>
            Dashboard
        </a>

        <a href="{{ route('jogos.index') }}" style="
            display: inline-flex; align-items: center; gap: 8px;
            padding: 0 14px; height: 36px; border-radius: var(--r-pill);
            font: 500 13.5px/1 Inter; text-decoration: none;
            color: {{ request()->routeIs('jogos*') ? '#fff' : 'var(--fg-secondary)' }};
            background: {{ request()->routeIs('jogos*') ? 'rgba(255,255,255,0.08)' : 'transparent' }};
            border: {{ request()->routeIs('jogos*') ? '1px solid var(--border-medium)' : '1px solid transparent' }};
        ">
            <span class="material-symbols-outlined" style="font-size: 18px; color: {{ request()->routeIs('jogos*') ? 'var(--br-yellow)' : 'var(--fg-muted)' }};">sports_soccer</span>
            Jogos
        </a>

        <a href="{{ route('meus-palpites') }}" style="
            display: inline-flex; align-items: center; gap: 8px;
            padding: 0 14px; height: 36px; border-radius: var(--r-pill);
            font: 500 13.5px/1 Inter; text-decoration: none;
            color: {{ request()->routeIs('meus-palpites') ? '#fff' : 'var(--fg-secondary)' }};
            background: {{ request()->routeIs('meus-palpites') ? 'rgba(255,255,255,0.08)' : 'transparent' }};
            border: {{ request()->routeIs('meus-palpites') ? '1px solid var(--border-medium)' : '1px solid transparent' }};
        ">
            <span class="material-symbols-outlined" style="font-size: 18px; color: {{ request()->routeIs('meus-palpites') ? 'var(--br-yellow)' : 'var(--fg-muted)' }};">emoji_events</span>
            Meus Palpites
        </a>

        @if(auth()->user()->isAdmin())
        <a href="{{ route('admin.jogos') }}" style="
            display: inline-flex; align-items: center; gap: 8px;
            padding: 0 14px; height: 36px; border-radius: var(--r-pill);
            font: 500 13.5px/1 Inter; text-decoration: none;
            color: {{ request()->routeIs('admin.*') ? '#fff' : 'var(--fg-secondary)' }};
            background: {{ request()->routeIs('admin.*') ? 'rgba(255,255,255,0.08)' : 'transparent' }};
            border: {{ request()->routeIs('admin.*') ? '1px solid var(--border-medium)' : '1px solid transparent' }};
        ">
            <span class="material-symbols-outlined" style="font-size: 18px; color: {{ request()->routeIs('admin.*') ? 'var(--br-yellow)' : 'var(--fg-muted)' }};">shield_person</span>
            Admin
        </a>
        @endif
    </nav>

    <div style="flex: 1;"></div>

    {{-- Indicador ativo (desktop only) --}}
    <div class="header-bolao-ativo" style="
        display: inline-flex; align-items: center; gap: 8px;
        padding: 0 12px; height: 32px; border-radius: var(--r-pill);
        border: 1px solid rgba(31,214,107,0.30); background: rgba(31,214,107,0.08);
        font: 600 11px/1 Inter; letter-spacing: .08em; text-transform: uppercase; color: #62F49B;
    ">
        <span style="width: 7px; height: 7px; border-radius: 99px; background: #1FD66B; box-shadow: 0 0 8px #1FD66B; display: inline-block;"></span>
        Bolão Ativo
    </div>

    {{-- Desktop user + logout --}}
    <div class="nav-user-desktop">
        <div style="
            width: 38px; height: 38px; border-radius: 50%;
            background: linear-gradient(135deg, #1FD66B 0%, #002776 100%);
            display: inline-flex; align-items: center; justify-content: center;
            font: 700 13px/1 Inter; color: #fff; border: 1px solid var(--border-medium);
        ">{{ strtoupper(substr(auth()->user()->nome, 0, 2)) }}</div>
        <div style="display: flex; flex-direction: column; line-height: 1.1;">
            <span style="font: 600 13px/1 Inter; color: #fff;">{{ auth()->user()->nome }}</span>
            <span style="font: 500 11px/1 Inter; color: var(--fg-muted); margin-top: 3px;">
                {{ auth()->user()->isAdmin() ? 'Admin' : 'Participante' }}
            </span>
        </div>
        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
            @csrf
            <button type="submit" class="btn-ghost" style="height: 34px; padding: 0 12px; font-size: 12px;">
                <span class="material-symbols-outlined" style="font-size: 16px;">logout</span>
                Sair
            </button>
        </form>
    </div>

    {{-- Hamburger (mobile) --}}
    <button class="nav-hamburger btn-ghost" style="height: 40px; padding: 0 12px;"
            @click="menuAberto = !menuAberto">
        <span class="material-symbols-outlined" x-text="menuAberto ? 'close' : 'menu'">menu</span>
    </button>

    {{-- Mobile drawer --}}
    <div class="nav-mobile-drawer" :class="{ 'aberto': menuAberto }" @click.self="menuAberto = false">
        {{-- Links --}}
        <div style="display: flex; flex-direction: column; gap: 4px;">
            @foreach([
                ['dashboard',    'dashboard',     'Dashboard',    'dashboard'],
                ['jogos.index',  'sports_soccer', 'Jogos',        'jogos*'],
                ['meus-palpites','emoji_events',  'Meus Palpites','meus-palpites'],
            ] as [$rota, $icon, $label, $match])
            <a href="{{ route($rota) }}" style="
                display: flex; align-items: center; gap: 14px;
                padding: 14px 16px; border-radius: var(--r-lg);
                font: 600 15px/1 Inter; text-decoration: none;
                color: {{ request()->routeIs($match) ? '#fff' : 'var(--fg-secondary)' }};
                background: {{ request()->routeIs($match) ? 'rgba(255,255,255,0.06)' : 'transparent' }};
            " @click="menuAberto = false">
                <span class="material-symbols-outlined" style="font-size: 22px; color: var(--fg-muted);">{{ $icon }}</span>
                {{ $label }}
            </a>
            @endforeach

            @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.jogos') }}" style="
                display: flex; align-items: center; gap: 14px;
                padding: 14px 16px; border-radius: var(--r-lg);
                font: 600 15px/1 Inter; text-decoration: none;
                color: {{ request()->routeIs('admin.*') ? '#fff' : 'var(--fg-secondary)' }};
                background: {{ request()->routeIs('admin.*') ? 'rgba(255,255,255,0.06)' : 'transparent' }};
            " @click="menuAberto = false">
                <span class="material-symbols-outlined" style="font-size: 22px; color: var(--br-yellow);">shield_person</span>
                Admin
            </a>
            @endif
        </div>

        <div style="height: 1px; background: var(--border-soft); margin: 16px 0;"></div>

        {{-- Usuário + logout --}}
        <div style="display: flex; align-items: center; gap: 12px; padding: 4px 0;">
            <div style="
                width: 42px; height: 42px; border-radius: 50%;
                background: linear-gradient(135deg, #1FD66B 0%, #002776 100%);
                display: inline-flex; align-items: center; justify-content: center;
                font: 700 14px/1 Inter; color: #fff; flex-shrink: 0;
            ">{{ strtoupper(substr(auth()->user()->nome, 0, 2)) }}</div>
            <div style="flex: 1;">
                <div style="font: 600 14px/1 Inter; color: #fff;">{{ auth()->user()->nome }}</div>
                <div style="font: 500 12px/1 Inter; color: var(--fg-muted); margin-top: 4px;">{{ auth()->user()->email }}</div>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-ghost" style="height: 40px; padding: 0 14px;">
                    <span class="material-symbols-outlined" style="font-size: 18px;">logout</span>
                </button>
            </form>
        </div>
    </div>
</header>

{{-- Conteúdo principal --}}
<main style="position: relative; z-index: 1;">
    {{ $slot }}
</main>

{{-- Toast container --}}
<div id="toast-container"
     x-data="toastManager()"
     x-on:toast.window="adicionar($event.detail)">
    <template x-for="(t, i) in toasts" :key="i">
        <div class="toast" :class="t.tipo">
            <span class="material-symbols-outlined" style="font-size: 18px;"
                  :style="t.tipo === 'sucesso' ? 'color:#62F49B' : 'color:#FF7A8E'"
                  x-text="t.tipo === 'sucesso' ? 'check_circle' : 'error'"></span>
            <span x-text="t.mensagem"></span>
        </div>
    </template>
</div>

@livewireScripts
@stack('scripts')

<script>
function toastManager() {
    return {
        toasts: [],
        adicionar(detail) {
            this.toasts.push({ mensagem: detail.mensagem, tipo: detail.tipo || 'sucesso' });
            const idx = this.toasts.length - 1;
            setTimeout(() => { this.toasts.splice(idx, 1); }, 3200);
        }
    };
}
</script>
</body>
</html>
