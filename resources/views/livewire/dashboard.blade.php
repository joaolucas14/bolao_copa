<div class="dash-grid" style="padding: 32px 32px 48px; max-width: 1440px; margin: 0 auto; display: grid; grid-template-columns: repeat(12, 1fr); gap: 22px;">

    {{-- ===== BANNER VENCEDOR ===== --}}
    @if($bolaoEncerrado && $vencedor)
    @php $isMe = $vencedor->id === auth()->id(); @endphp
    <div style="grid-column: 1 / -1; border-radius: var(--r-2xl); overflow: hidden; position: relative;
        background: linear-gradient(135deg, #1A1206 0%, #2A1E00 40%, #1A1206 100%);
        border: 1px solid rgba(242,201,76,0.50);
        box-shadow: 0 0 60px rgba(242,201,76,0.15);">

        {{-- Brilho de fundo --}}
        <div style="position: absolute; top: -60px; left: 50%; transform: translateX(-50%); width: 500px; height: 200px; border-radius: 50%; background: radial-gradient(circle, rgba(242,201,76,0.25) 0%, transparent 70%); filter: blur(30px); pointer-events: none;"></div>

        <div style="position: relative; z-index: 2; display: flex; align-items: center; gap: 32px; padding: 28px 36px; flex-wrap: wrap;">

            {{-- Troféu --}}
            <div style="width: 72px; height: 72px; border-radius: var(--r-xl); background: var(--grad-gold-chip); display: inline-flex; align-items: center; justify-content: center; box-shadow: 0 12px 30px rgba(242,201,76,0.40), 0 1px 0 rgba(255,255,255,0.5) inset; flex-shrink: 0;">
                <span class="material-symbols-outlined ms-fill" style="font-size: 40px; color: #5A3A00;">emoji_events</span>
            </div>

            {{-- Info vencedor --}}
            <div style="flex: 1; min-width: 200px;">
                <div style="font: 700 11px/1 Inter; letter-spacing: .18em; text-transform: uppercase; color: #FFD96B; margin-bottom: 8px;">
                    🏆 Bolão Innovate Copa 2026 — Vencedor
                </div>
                <div style="display: flex; align-items: center; gap: 14px;">
                    <div style="width: 52px; height: 52px; border-radius: 50%; background: linear-gradient(135deg, #F2C94C 0%, #9A6300 100%); display: inline-flex; align-items: center; justify-content: center; font: 800 18px/1 Inter; color: #1A0F00; border: 2px solid rgba(242,201,76,0.60); flex-shrink: 0; box-shadow: 0 4px 12px rgba(242,201,76,0.30);">
                        {{ strtoupper(substr($vencedor->nome, 0, 2)) }}
                    </div>
                    <div>
                        <div style="font: 900 26px/1 Inter; letter-spacing: -0.02em; color: #FFE08A;">
                            {{ $vencedor->nome }}
                            @if($isMe)
                            <span style="margin-left: 10px; padding: 3px 10px; border-radius: var(--r-pill); background: rgba(242,201,76,0.20); border: 1px solid rgba(242,201,76,0.50); font: 700 10px/1 Inter; letter-spacing: .12em; color: #FFD96B; vertical-align: middle;">VOCÊ</span>
                            @endif
                        </div>
                        <div style="font: 500 13px/1 Inter; color: var(--fg-secondary); margin-top: 6px;">1º lugar no ranking final</div>
                    </div>
                </div>
            </div>

            {{-- Placar de pontos --}}
            <div style="display: flex; gap: 16px; flex-wrap: wrap;">
                <div style="text-align: center; padding: 16px 20px; border-radius: var(--r-lg); background: rgba(0,0,0,0.30); border: 1px solid rgba(242,201,76,0.20);">
                    <div style="font: 900 36px/1 Inter; font-variant-numeric: tabular-nums; letter-spacing: -0.03em; color: #FFE08A;">
                        {{ number_format($vencedor->palpites_sum_pontuacao ?? 0, 1) }}
                    </div>
                    <div style="font: 600 10px/1 Inter; letter-spacing: .14em; text-transform: uppercase; color: var(--fg-muted); margin-top: 6px;">pontos</div>
                </div>
                <div style="display: flex; flex-direction: column; gap: 8px; justify-content: center;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span class="chip green" style="font-size: 11px;">
                            <span class="material-symbols-outlined" style="font-size: 12px;">gps_fixed</span>
                            {{ $vencedor->exatos ?? 0 }} exatos
                        </span>
                        <span class="chip yellow" style="font-size: 11px;">
                            <span class="material-symbols-outlined" style="font-size: 12px;">flag_circle</span>
                            {{ $vencedor->ganhadores ?? 0 }} ganhadores
                        </span>
                    </div>
                    <div>
                        <span class="chip" style="font-size: 11px;">
                            <span class="material-symbols-outlined" style="font-size: 12px;">percent</span>
                            {{ $vencedor->parciais ?? 0 }} parciais
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Saudação --}}
    <div class="dash-greeting" style="grid-column: 1 / -1; display: flex; align-items: flex-end; justify-content: space-between;">
        <div>
            <div style="font: 600 11px/1 Inter; letter-spacing: .16em; text-transform: uppercase; color: var(--br-yellow); margin-bottom: 12px;">
                <span class="material-symbols-outlined" style="font-size: 13px; vertical-align: -2px; margin-right: 6px;">waving_hand</span>
                Olá, {{ explode(' ', auth()->user()->nome)[0] }}
            </div>
            <h1 style="margin: 0; font: 800 34px/1.1 Inter; letter-spacing: -0.025em; color: #fff;">
                @if($proximoJogo && $proximoJogo->data_hora)
                    @if($proximoJogo->data_hora->isPast())
                        <span style="color: var(--br-yellow);">Jogo em andamento!</span>
                    @elseif(now()->addHour()->greaterThanOrEqualTo($proximoJogo->data_hora))
                        Palpites encerrados — <span style="color: var(--br-yellow);">jogo em breve!</span>
                    @else
                        Faltam <span style="color: var(--br-yellow);">{{ $proximoJogo->data_hora->diffForHumans(['parts' => 1, 'short' => true, 'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE]) }}</span> pro próximo jogo.
                    @endif
                @else
                    Bem-vindo ao <span style="color: var(--br-yellow);">Bolão Innovate</span>!
                @endif
            </h1>
            <p style="margin: 10px 0 0; font: 500 14px/1.5 Inter; color: var(--fg-secondary); max-width: 600px;">
                @if($proximoJogo)
                    Brasil enfrenta {{ $proximoJogo->adversario ?? '???' }}. Registre seu palpite antes do apito inicial.
                @else
                    Nenhum jogo programado no momento. Aguarde o admin cadastrar os próximos jogos.
                @endif
            </p>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('meus-palpites') }}" class="btn-ghost" style="height: 40px; text-decoration: none;">
                <span class="material-symbols-outlined" style="font-size: 18px;">emoji_events</span>
                Meus palpites
            </a>
        </div>
    </div>

    {{-- Hero: próximo jogo --}}
    @if($proximoJogo)
    <div class="card dash-hero" style="
        grid-column: 1 / span 8; padding: 0; overflow: hidden;
        background: linear-gradient(180deg, #0E1A4A 0%, #07102C 100%);
        border: 1px solid rgba(255,255,255,0.10); border-radius: var(--r-2xl); position: relative;
    ">
        <div style="position: absolute; top: 0; right: 0; width: 380px; height: 100%; opacity: .6; pointer-events: none;
             background: radial-gradient(ellipse 80% 60% at 100% 30%, rgba(254,223,0,0.18) 0%, transparent 60%);"></div>

        <div style="display: flex; align-items: center; justify-content: space-between; padding: 18px 28px; border-bottom: 1px solid var(--border-soft); position: relative; z-index: 2;">
            <div style="display: flex; gap: 10px; align-items: center;">
                <span class="chip yellow">
                    <span class="material-symbols-outlined" style="font-size: 13px;">schedule</span>
                    Próximo jogo
                </span>
                <span class="chip">{{ \App\Models\Jogo::FASES[$proximoJogo->fase] ?? ucfirst($proximoJogo->fase) }}</span>
            </div>
            @if($proximoJogo->data_hora)
            <div style="font: 500 12.5px/1 Inter; color: var(--fg-muted);">
                <span class="material-symbols-outlined" style="font-size: 14px; vertical-align: -2px; margin-right: 6px; color: var(--fg-faint);">event</span>
                {{ $proximoJogo->data_hora->translatedFormat('d M Y · H:i') }} (Brasília)
            </div>
            @endif
        </div>

        <div class="hero-matchup" style="display: grid; grid-template-columns: 1fr auto 1fr; align-items: center; gap: 24px; padding: 36px 40px 28px; position: relative; z-index: 2;">
            {{-- Brasil --}}
            <div style="display: flex; flex-direction: column; align-items: center; gap: 14px;">
                <img src="{{ asset('images/bandeira-brasil.png') }}" alt="Brasil"
                     style="width: 108px; height: 76px; border-radius: 6px; object-fit: contain; box-shadow: 0 6px 18px rgba(0,0,0,0.35);" />
                <div style="text-align: center;">
                    <div style="font: 800 38px/1 Inter; letter-spacing: -0.04em; color: #fff;">BRA</div>
                    <div style="font: 500 12.5px/1 Inter; color: var(--fg-muted); margin-top: 8px; letter-spacing: .08em;">BRASIL</div>
                </div>
            </div>

            {{-- VS + countdown --}}
            <div class="hero-vs" style="display: flex; flex-direction: column; align-items: center; gap: 16px; min-width: 280px;">
                <div style="font: 900 56px/1 Inter; letter-spacing: -0.06em; color: var(--fg-faint);">VS</div>
                <livewire:countdown :jogoId="$proximoJogo->id" />
                <div style="display: inline-flex; gap: 8px; align-items: center; font: 600 12px/1 Inter; color: var(--fg-secondary);">
                    <span class="material-symbols-outlined" style="font-size: 14px; color: var(--br-yellow);">event</span>
                    {{ $proximoJogo->data_hora ? $proximoJogo->data_hora->translatedFormat('d M Y · H:i') . ' BRT' : 'Data a definir' }}
                </div>
            </div>

            {{-- Adversário --}}
            <div style="display: flex; flex-direction: column; align-items: center; gap: 14px;">
                <img src="{{ $proximoJogo->foto_url }}" alt="{{ $proximoJogo->adversario ?? '???' }}"
                     style="width: 108px; height: 76px; border-radius: 6px; object-fit: contain; background: var(--bg-elev-1); border: 1px solid var(--border-medium);" />
                <div style="text-align: center;">
                    <div style="font: 800 28px/1 Inter; letter-spacing: -0.03em; color: #fff;">{{ strtoupper(substr($proximoJogo->adversario ?? '???', 0, 3)) }}</div>
                    <div style="font: 500 12.5px/1 Inter; color: var(--fg-muted); margin-top: 8px; letter-spacing: .08em;">{{ strtoupper($proximoJogo->adversario ?? 'A DEFINIR') }}</div>
                </div>
            </div>
        </div>

        <div style="display: flex; align-items: center; justify-content: space-between; padding: 18px 28px; border-top: 1px solid var(--border-soft); background: rgba(0,0,0,0.20); position: relative; z-index: 2;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 36px; height: 36px; border-radius: var(--r-pill); border: 1px solid rgba(255,77,106,0.40); background: rgba(255,77,106,0.10); display: inline-flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined" style="font-size: 18px; color: #FF7A8E;">timer</span>
                </div>
                <div
                    @if($proximoJogo->data_hora)
                    x-data="bolaoDeadline({{ $proximoJogo->data_hora->timestamp * 1000 }})"
                    x-init="init()"
                    @endif
                >
                    <div style="font: 700 13px/1 Inter; color: #ffffff;"
                        @if($proximoJogo->data_hora) x-text="texto" @endif
                    >
                        @if(!$proximoJogo->data_hora)
                            Palpites encerrados
                        @endif
                    </div>
                    <div style="font: 500 12px/1 Inter; color: var(--fg-muted); margin-top: 5px;">1 hora antes do apito inicial, nenhum palpite poderá ser enviado.</div>
                </div>
            </div>
            @if($meuPalpiteProximo)
            <a href="{{ route('jogos.show', $proximoJogo) }}" class="btn-ghost" style="height: 52px; font-size: 14.5px; text-decoration: none;">
                <span class="material-symbols-outlined" style="font-size: 18px;">visibility</span>
                Ver meu palpite
                <span class="material-symbols-outlined" style="font-size: 18px;">arrow_forward</span>
            </a>
            @elseif($proximoJogo->status === 'aberto' && $proximoJogo->data_hora && !now()->addHour()->greaterThanOrEqualTo($proximoJogo->data_hora))
            <a href="{{ route('jogos.show', $proximoJogo) }}" class="btn-gold" style="height: 52px; font-size: 14.5px; text-decoration: none;">
                <span class="material-symbols-outlined" style="font-size: 18px;">edit_note</span>
                Fazer meu palpite
                <span class="material-symbols-outlined" style="font-size: 18px;">arrow_forward</span>
            </a>
            @else
            <span class="chip">Palpites fechados</span>
            @endif
        </div>
    </div>
    @endif

    {{-- Card prêmio --}}
    <div class="card dash-premio" style="
        grid-column: span 4; padding: 24px; border-radius: var(--r-2xl);
        background: linear-gradient(180deg, #1A1206 0%, #0A0703 100%);
        border: 1px solid rgba(242,201,76,0.30); position: relative; overflow: hidden;
    ">
        <div style="position: absolute; top: -80px; right: -80px; width: 240px; height: 240px; border-radius: 50%; background: radial-gradient(circle, rgba(242,201,76,0.30) 0%, transparent 70%); filter: blur(20px);"></div>
        <div style="position: relative; z-index: 2;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px;">
                <span class="chip gold">
                    <span class="material-symbols-outlined" style="font-size: 13px;">emoji_events</span>
                    Prêmio do Bolão
                </span>
            </div>
            <div style="display: flex; justify-content: center; margin-bottom: 12px;">
                <div style="width: 64px; height: 64px; border-radius: var(--r-lg); background: var(--grad-gold-chip); display: inline-flex; align-items: center; justify-content: center; box-shadow: 0 12px 30px rgba(242,201,76,0.30), 0 1px 0 rgba(255,255,255,0.6) inset;">
                    <span class="material-symbols-outlined ms-fill" style="font-size: 36px; color: #5A3A00;">trophy</span>
                </div>
            </div>
            <div style="text-align: center;">
                @if($premioValor && $premioValor !== '0')
                <div style="font: 900 52px/1 Inter; letter-spacing: -0.04em; color: #FFE08A; text-shadow: 0 4px 12px rgba(242,201,76,0.30);">
                    R$ <span style="font-size: 64px;">{{ $premioValor }}</span>
                </div>
                @endif
                @if($premioBonus)
                <div style="font: 600 13px/1 Inter; color: var(--fg-secondary); margin-top: 10px;">
                    + <span style="color: #FFD96B; font-weight: 700;">{{ $premioBonus }}</span>
                </div>
                @endif
                @if(!$premioValor || $premioValor === '0')
                <div style="font: 700 22px/1 Inter; color: var(--fg-muted); margin-top: 10px;">{{ $premioDescricao }}</div>
                @endif
            </div>
        </div>
    </div>

    {{-- Ranking --}}
    <div class="card dash-ranking card-scroll" style="grid-column: span 8; padding: 0; border-radius: var(--r-2xl); overflow: hidden;">
        <div style="display: flex; align-items: center; justify-content: space-between; padding: 20px 26px; border-bottom: 1px solid var(--border-soft);">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 36px; height: 36px; border-radius: var(--r-md); background: rgba(242,201,76,0.10); border: 1px solid rgba(242,201,76,0.30); display: inline-flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined" style="font-size: 20px; color: #FFD96B;">leaderboard</span>
                </div>
                <div>
                    <div style="font: 700 16px/1 Inter; color: #fff;">Ranking geral</div>
                    <div style="font: 500 12px/1 Inter; color: var(--fg-muted); margin-top: 5px;">{{ $ranking->count() }} participantes</div>
                </div>
            </div>
        </div>

        {{-- Header da tabela --}}
        <div class="tbl-row" style="grid-template-columns: 60px 1fr 100px 80px 90px 80px; padding: 12px 26px; background: rgba(255,255,255,0.02); font: 600 10.5px/1 Inter; letter-spacing: .12em; text-transform: uppercase; color: var(--fg-muted); border-bottom: 1px solid var(--border-medium);">
            <div>POS</div>
            <div>Participante</div>
            <div style="text-align: right;">Total</div>
            <div style="text-align: right;">Exato</div>
            <div style="text-align: right;">Ganhador</div>
            <div style="text-align: right;">Parcial</div>
        </div>

        @foreach($ranking->take(10) as $i => $usuario)
        @php
            $pos = $i + 1;
            $isMe = $usuario->id === auth()->id();
            $medalhas = [1 => ['bg' => '#F2C94C', 'fg' => '#5A3A00'], 2 => ['bg' => '#C8CDE4', 'fg' => '#202649'], 3 => ['bg' => '#C77B3E', 'fg' => '#2A1606']];
            $pts = number_format($usuario->palpites_sum_pontuacao ?? 0, 1);
        @endphp
        <div class="tbl-row" style="grid-template-columns: 60px 1fr 100px 80px 90px 80px; padding: 14px 26px; background: {{ $isMe ? 'rgba(31,214,107,0.06)' : 'transparent' }}; position: relative;">
            @if($isMe)
            <div style="position: absolute; left: 0; top: 0; bottom: 0; width: 3px; background: var(--br-green-bright);"></div>
            @endif
            <div>
                @if(isset($medalhas[$pos]))
                <div style="width: 32px; height: 32px; border-radius: var(--r-md); background: linear-gradient(180deg, {{ $medalhas[$pos]['bg'] }} 0%, color-mix(in srgb, {{ $medalhas[$pos]['bg'] }} 70%, black) 100%); display: inline-flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(0,0,0,0.4), 0 1px 0 rgba(255,255,255,0.4) inset;">
                    <span class="material-symbols-outlined ms-fill" style="font-size: 18px; color: {{ $medalhas[$pos]['fg'] }};">military_tech</span>
                </div>
                @else
                <div style="width: 32px; height: 32px; border-radius: var(--r-md); background: rgba(255,255,255,0.04); border: 1px solid var(--border-medium); display: inline-flex; align-items: center; justify-content: center; font: 700 13px/1 Inter; color: var(--fg-secondary);">{{ $pos }}</div>
                @endif
            </div>
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 34px; height: 34px; border-radius: 50%; background: linear-gradient(135deg, #1FD66B 0%, #006B28 100%); display: inline-flex; align-items: center; justify-content: center; font: 700 12px/1 Inter; color: #fff; border: 1px solid var(--border-medium); flex-shrink: 0;">{{ strtoupper(substr($usuario->nome, 0, 2)) }}</div>
                <div>
                    <div style="font: 600 14px/1 Inter; color: #fff;">
                        {{ $usuario->nome }}
                        @if($isMe)
                        <span style="display: inline-flex; align-items: center; justify-content: center; margin-left: 8px; padding: 2px 7px; border-radius: var(--r-pill); background: rgba(31,214,107,0.15); border: 1px solid rgba(31,214,107,0.40); font: 700 9.5px/1 Inter; letter-spacing: .10em; color: #62F49B;">VOCÊ</span>
                        @endif
                    </div>
                </div>
            </div>
            <div style="text-align: right;">
                <span style="font: 800 18px/1 Inter; color: {{ $pos === 1 ? '#FFD96B' : '#fff' }}; font-variant-numeric: tabular-nums;">{{ $pts }}</span>
                <span style="font: 500 10px/1 Inter; color: var(--fg-muted); margin-left: 3px;">pts</span>
            </div>
            <div style="text-align: right; font: 600 14px/1 Inter; color: {{ ($usuario->exatos ?? 0) > 0 ? '#62F49B' : 'var(--fg-muted)' }}; font-variant-numeric: tabular-nums;">{{ $usuario->exatos ?? 0 }}</div>
            <div style="text-align: right; font: 600 14px/1 Inter; color: #fff; font-variant-numeric: tabular-nums;">{{ $usuario->ganhadores ?? 0 }}</div>
            <div style="text-align: right; font: 600 14px/1 Inter; color: var(--fg-secondary); font-variant-numeric: tabular-nums;">{{ $usuario->parciais ?? 0 }}</div>
        </div>
        @endforeach

        @if($ranking->count() > 10)
        <div style="padding: 14px 26px; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--border-soft); background: rgba(255,255,255,0.02);">
            <span style="font: 500 12px/1 Inter; color: var(--fg-muted);">Mostrando 10 de {{ $ranking->count() }} participantes</span>
        </div>
        @endif
    </div>

    {{-- Último resultado --}}
    @if($ultimoJogo)
    <div class="card dash-ultimo" style="grid-column: span 4; padding: 0; border-radius: var(--r-2xl); overflow: hidden;">
        <div style="padding: 20px 24px; border-bottom: 1px solid var(--border-soft); display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font: 700 15px/1 Inter; color: #fff;">Último resultado</div>
                <div style="font: 500 12px/1 Inter; color: var(--fg-muted); margin-top: 5px;">{{ \App\Models\Jogo::FASES[$ultimoJogo->fase] ?? ucfirst($ultimoJogo->fase) }}</div>
            </div>
            <span class="chip green">
                <span style="width: 6px; height: 6px; border-radius: 99px; background: #1FD66B; display: inline-block;"></span>
                Encerrado
            </span>
        </div>
        <div style="padding: 24px 24px 18px; background: linear-gradient(180deg, rgba(0,156,59,0.08) 0%, transparent 100%); display: grid; grid-template-columns: 1fr auto 1fr; align-items: center; gap: 12px;">
            <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                <img src="{{ asset('images/bandeira-brasil.png') }}" alt="Brasil"
                     style="width: 48px; height: 34px; border-radius: 4px; object-fit: contain; box-shadow: 0 4px 12px rgba(0,0,0,0.3);" />
                <div style="font: 700 13px/1 Inter; color: #fff;">Brasil</div>
            </div>
            <div style="display: flex; align-items: center; gap: 8px; font: 900 44px/1 Inter; letter-spacing: -0.04em; color: #fff; font-variant-numeric: tabular-nums;">
                <span style="color: var(--br-yellow);">{{ $ultimoJogo->gols_brasil }}</span>
                <span style="color: var(--fg-faint); font-size: 28px;">×</span>
                <span>{{ $ultimoJogo->gols_adversario }}</span>
            </div>
            <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                <img src="{{ $ultimoJogo->foto_url }}" alt="{{ $ultimoJogo->adversario ?? '???' }}"
                     style="width: 48px; height: 34px; border-radius: 4px; object-fit: contain; background: var(--bg-elev-1); border: 1px solid var(--border-soft);" />
                <div style="font: 700 13px/1 Inter; color: #fff;">{{ $ultimoJogo->adversario }}</div>
            </div>
        </div>

        @if($palpiteiroDaRodada)
        <div style="padding: 14px 20px; border-top: 1px solid var(--border-soft); background: rgba(242,201,76,0.05); display: flex; align-items: center; gap: 12px;">
            <div style="width: 32px; height: 32px; border-radius: var(--r-md); background: var(--grad-gold-chip); display: inline-flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(242,201,76,0.25); flex-shrink: 0;">
                <span class="material-symbols-outlined ms-fill" style="font-size: 17px; color: #5A3A00;">military_tech</span>
            </div>
            <div style="flex: 1; min-width: 0;">
                <div style="font: 600 10px/1 Inter; letter-spacing: .12em; text-transform: uppercase; color: #FFD96B; margin-bottom: 4px;">Palpiteiro da rodada</div>
                <div style="font: 700 13px/1 Inter; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $palpiteiroDaRodada->usuario->nome }}</div>
            </div>
            <div style="text-align: right; flex-shrink: 0;">
                <div style="font: 800 18px/1 Inter; font-variant-numeric: tabular-nums; color: #FFD96B;">+{{ number_format($palpiteiroDaRodada->pontuacao, 1) }}</div>
                <div style="font: 500 10px/1 Inter; color: var(--fg-muted); margin-top: 3px;">pontos</div>
            </div>
        </div>
        @endif
    </div>
    @endif
</div>
