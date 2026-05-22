<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login — Bolão Innovate</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="
    margin: 0; padding: 0;
    background: radial-gradient(ellipse 90% 65% at 30% 0%, rgba(0,39,118,0.55) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 85% 30%, rgba(254,223,0,0.10) 0%, transparent 65%),
                linear-gradient(180deg, #0A1131 0%, #050B1F 100%);
    min-height: 100vh;
    display: flex; align-items: center; justify-content: center;
    font-family: 'Inter', system-ui, sans-serif;
    -webkit-font-smoothing: antialiased;
    position: relative; overflow: hidden;
">

    {{-- Elemento gráfico: círculo do campo --}}
    <svg width="100%" height="100%" viewBox="0 0 1280 800" preserveAspectRatio="xMidYMid slice"
         style="position: absolute; inset: 0; pointer-events: none; opacity: .4; z-index: 0;">
        <defs>
            <radialGradient id="bglogin" cx="0.5" cy="0.5">
                <stop offset="0%" stop-color="rgba(0,156,59,0.18)" />
                <stop offset="100%" stop-color="rgba(0,156,59,0)" />
            </radialGradient>
        </defs>
        <ellipse cx="640" cy="400" rx="520" ry="320" fill="url(#bglogin)" />
        <circle cx="640" cy="400" r="240" stroke="rgba(255,255,255,0.05)" stroke-width="1" fill="none" />
        <circle cx="640" cy="400" r="2.5" fill="rgba(254,223,0,0.6)" />
        {{-- losango da bandeira --}}
        <path d="M 640 80 L 1200 400 L 640 720 L 80 400 Z" stroke="rgba(254,223,0,0.06)" stroke-width="1.5" fill="none" />
    </svg>

    {{-- Card de login --}}
    <div style="
        position: relative; z-index: 5;
        width: 460px;
        padding: 44px 44px 36px;
        background: rgba(10,17,49,0.85);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.10);
        border-radius: var(--r-2xl);
        box-shadow: 0 30px 80px rgba(0,0,0,0.55), 0 0 0 1px rgba(255,255,255,0.04) inset;
    ">

        {{-- Logo e cabeçalho --}}
        <div style="display: flex; flex-direction: column; align-items: center; gap: 20px; margin-bottom: 32px;">
            {{-- Logo Innovate --}}
            <div style="
                padding: 14px 28px;
                border-radius: var(--r-xl);
                background: #fff;
                border: 1px solid rgba(255,255,255,0.15);
                box-shadow: 0 8px 30px rgba(0,0,0,0.45);
            ">
                <img src="{{ asset('design/assets/innovate-logo.png') }}"
                     alt="Innovate Automação"
                     style="height: 44px; width: auto; object-fit: contain; display: block;" />
            </div>

            <div style="text-align: center;">
                <div style="
                    display: inline-flex; gap: 8px; align-items: center;
                    padding: 4px 12px; border-radius: var(--r-pill);
                    background: rgba(254,223,0,0.10); border: 1px solid rgba(254,223,0,0.30);
                    font: 700 10.5px/1 Inter; letter-spacing: .18em; text-transform: uppercase;
                    color: var(--br-yellow); margin-bottom: 16px;
                ">
                    <span class="material-symbols-outlined" style="font-size: 13px;">workspace_premium</span>
                    Edição Copa do Mundo 2026
                </div>
                <h1 style="margin: 0; font: 800 30px/1.1 Inter; letter-spacing: -0.025em; color: #fff;">
                    Bolão Innovate
                </h1>
                <p style="margin: 10px 0 0; font: 500 14px/1.5 Inter; color: var(--fg-muted); max-width: 320px; margin-inline: auto;">
                    Entre com seu e-mail corporativo para registrar seus palpites dos jogos do Brasil.
                </p>
            </div>
        </div>

        {{-- Erros --}}
        @if ($errors->any())
        <div style="
            margin-bottom: 16px; padding: 12px 14px;
            border-radius: var(--r-md);
            background: rgba(255,77,106,0.10); border: 1px solid rgba(255,77,106,0.35);
            display: flex; align-items: flex-start; gap: 10px;
        ">
            <span class="material-symbols-outlined" style="font-size: 16px; color: #FF7A8E; margin-top: 2px;">error</span>
            <span style="font: 500 13px/1.45 Inter; color: var(--fg-secondary);">{{ $errors->first() }}</span>
        </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="/login" style="display: flex; flex-direction: column; gap: 16px;">
            @csrf

            <div>
                <label class="field-label">E-mail corporativo</label>
                <div style="position: relative;">
                    <span class="material-symbols-outlined" style="
                        position: absolute; left: 16px; top: 50%; transform: translateY(-50%);
                        color: var(--fg-muted); font-size: 20px;
                    ">mail</span>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="seu@innovate.com.br"
                        autocomplete="email"
                        class="input-dark"
                        required
                    />
                </div>
            </div>

            <div>
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                    <label class="field-label" style="margin: 0;">Senha</label>
                </div>
                <div style="position: relative;">
                    <span class="material-symbols-outlined" style="
                        position: absolute; left: 16px; top: 50%; transform: translateY(-50%);
                        color: var(--fg-muted); font-size: 20px;
                    ">lock</span>
                    <input
                        type="password"
                        name="password"
                        placeholder="••••••••"
                        autocomplete="current-password"
                        class="input-dark"
                        required
                    />
                </div>
            </div>

            <label style="
                display: inline-flex; align-items: center; gap: 10px;
                font: 500 13px/1 Inter; color: var(--fg-secondary); cursor: pointer; margin-top: 4px;
            ">
                <input type="checkbox" name="lembrar" value="1" style="display: none;" />
                <span style="
                    width: 18px; height: 18px; border-radius: 5px;
                    background: var(--br-green); border: 1px solid var(--br-green-bright);
                    display: inline-flex; align-items: center; justify-content: center;
                    box-shadow: 0 0 0 3px rgba(31,214,107,0.10);
                ">
                    <span class="material-symbols-outlined" style="font-size: 14px; color: #fff; font-variation-settings: 'wght' 800;">check</span>
                </span>
                Manter conectado neste dispositivo
            </label>

            <button type="submit" class="btn-primary" style="height: 54px; margin-top: 8px; font-size: 15px;">
                Entrar
                <span class="material-symbols-outlined" style="font-size: 18px;">arrow_forward</span>
            </button>

            <div style="
                margin-top: 14px; padding: 14px 16px;
                border-radius: var(--r-md);
                background: rgba(0,39,118,0.35); border: 1px solid rgba(91,180,255,0.25);
                display: flex; align-items: flex-start; gap: 10px;
            ">
                <span class="material-symbols-outlined" style="font-size: 18px; color: #8EA9FF; margin-top: 1px;">info</span>
                <div style="font: 500 12.5px/1.5 Inter; color: var(--fg-secondary);">
                    Apenas colaboradores Innovate com e-mail <strong style="color: #fff;">@innovate.com.br</strong> podem participar.
                </div>
            </div>
        </form>
    </div>

    {{-- Footer --}}
    <div style="
        position: absolute; bottom: 24px; left: 0; right: 0;
        display: flex; justify-content: center;
        font: 500 11px/1 Inter; color: var(--fg-faint); letter-spacing: .16em; text-transform: uppercase;
    ">
        <span style="display: inline-flex; align-items: center; gap: 14px;">
            <span>Powered by Innovate Automação</span>
            <span style="width: 3px; height: 3px; border-radius: 99px; background: var(--fg-faint); display: inline-block;"></span>
            <span>7 jogos</span>
            <span style="width: 3px; height: 3px; border-radius: 99px; background: var(--fg-faint); display: inline-block;"></span>
            <span>Prêmio a definir</span>
        </span>
    </div>
</body>
</html>
