<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Página não encontrada — Bolão Innovate</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    @vite(['resources/css/app.css'])
</head>
<body style="background: var(--bg-base); min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 32px;">

    {{-- Decoração --}}
    <div style="position: fixed; inset: 0; pointer-events: none; overflow: hidden; opacity: .5;">
        <svg width="100%" height="100%" viewBox="0 0 1440 900" preserveAspectRatio="xMidYMid slice">
            <defs>
                <radialGradient id="navyglow" cx="0.5" cy="0.5">
                    <stop offset="0%" stop-color="#002776" stop-opacity="0.50" />
                    <stop offset="100%" stop-color="#002776" stop-opacity="0" />
                </radialGradient>
            </defs>
            <rect x="0" y="0" width="1440" height="900" fill="url(#navyglow)" />
        </svg>
    </div>

    <div style="position: relative; text-align: center; max-width: 480px;">
        {{-- Número 404 estilizado --}}
        <div style="font: 900 140px/1 Inter; letter-spacing: -0.06em; font-variant-numeric: tabular-nums; background: linear-gradient(180deg, #FEDF00 0%, rgba(254,223,0,0.30) 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1; margin-bottom: 8px;">
            404
        </div>

        <div style="width: 64px; height: 64px; border-radius: var(--r-lg); background: rgba(254,223,0,0.10); border: 1px solid rgba(254,223,0,0.25); display: inline-flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
            <span class="material-symbols-outlined" style="font-size: 32px; color: var(--br-yellow);">sports_soccer</span>
        </div>

        <h1 style="margin: 0 0 12px; font: 800 28px/1.15 Inter; letter-spacing: -0.02em; color: #fff;">
            Fora de jogo!
        </h1>
        <p style="margin: 0 0 28px; font: 500 15px/1.6 Inter; color: var(--fg-secondary);">
            A página que você tentou acessar não existe ou foi removida. Nenhum árbitro conseguiu encontrar.
        </p>

        @if(auth()->check())
        <a href="{{ route('dashboard') }}" class="btn-primary" style="text-decoration: none;">
            <span class="material-symbols-outlined" style="font-size: 18px;">home</span>
            Voltar ao Dashboard
        </a>
        @else
        <a href="{{ route('login') }}" class="btn-primary" style="text-decoration: none;">
            <span class="material-symbols-outlined" style="font-size: 18px;">login</span>
            Ir para o Login
        </a>
        @endif
    </div>
</body>
</html>
