<div style="padding: 28px 32px 56px; max-width: 980px; margin: 0 auto;">

    {{-- ===================== HEADER ===================== --}}
    <div class="card grain" style="padding: 36px 40px; border-radius: var(--r-2xl); background: linear-gradient(160deg, #0E1A4A 0%, #07102C 100%); margin-bottom: 24px; position: relative; overflow: hidden;">

        {{-- Decoração campo --}}
        <svg width="100%" height="100%" viewBox="0 0 900 220" preserveAspectRatio="none"
             style="position: absolute; inset: 0; pointer-events: none; opacity: .35;">
            <line x1="450" y1="0" x2="450" y2="220" stroke="rgba(255,255,255,0.06)" stroke-width="1"/>
            <ellipse cx="450" cy="110" rx="70" ry="70" stroke="rgba(255,255,255,0.06)" stroke-width="1" fill="none"/>
            <rect x="1" y="40" width="100" height="140" stroke="rgba(255,255,255,0.05)" stroke-width="1" fill="none"/>
            <rect x="1" y="70" width="45" height="80" stroke="rgba(255,255,255,0.05)" stroke-width="1" fill="none"/>
            <rect x="799" y="40" width="100" height="140" stroke="rgba(255,255,255,0.05)" stroke-width="1" fill="none"/>
            <rect x="854" y="70" width="45" height="80" stroke="rgba(255,255,255,0.05)" stroke-width="1" fill="none"/>
        </svg>

        <div style="position: relative; display: flex; align-items: center; gap: 40px; flex-wrap: wrap;">

            {{-- Brasil --}}
            <div style="display: flex; flex-direction: column; align-items: center; gap: 10px; flex: 0 0 auto;">
                <svg width="100" height="70" viewBox="0 0 80 56" style="border-radius: 8px; box-shadow: 0 8px 24px rgba(0,0,0,0.45);">
                    <rect width="80" height="56" fill="#009C3B"/>
                    <path d="M40 6 L74 28 L40 50 L6 28 Z" fill="#FEDF00"/>
                    <circle cx="40" cy="28" r="11" fill="#002776"/>
                    <path d="M30 26 Q 40 22, 50 26" stroke="#fff" stroke-width="1.2" fill="none"/>
                </svg>
                <span style="font: 800 15px/1 Inter; letter-spacing: .06em; color: #fff; text-transform: uppercase;">Brasil</span>
            </div>

            {{-- Placar / Info --}}
            <div style="flex: 1; min-width: 200px; text-align: center;">
                @if($jogo->estaEncerrado() && $jogo->gols_brasil !== null)
                <div style="font: 900 72px/1 Inter; font-variant-numeric: tabular-nums; letter-spacing: -0.06em; color: var(--br-yellow); text-shadow: 0 4px 0 rgba(0,0,0,0.4), 0 0 40px rgba(254,223,0,0.40);">
                    {{ $jogo->gols_brasil }} <span style="color: var(--fg-faint); font-size: 48px; letter-spacing: -0.02em;">×</span> {{ $jogo->gols_adversario }}
                </div>
                @if($jogo->penaltis)
                <div style="margin-top: 6px; font: 600 12px/1 Inter; color: var(--fg-muted); letter-spacing: .10em; text-transform: uppercase;">Penaltis não contam</div>
                @endif
                @else
                <div style="display: flex; align-items: center; justify-content: center; gap: 8px; margin-bottom: 12px;">
                    @php
                        $faseLabel = \App\Models\Jogo::FASES[$jogo->fase] ?? ucfirst($jogo->fase);
                    @endphp
                    <span class="chip">{{ $faseLabel }}</span>
                    @if($jogo->data_hora)
                    <span class="chip yellow">
                        <span class="material-symbols-outlined" style="font-size: 12px;">calendar_month</span>
                        {{ $jogo->data_hora->format('d/m H:i') }}
                    </span>
                    @endif
                </div>
                <div style="font: 900 52px/1 Inter; letter-spacing: -0.06em; color: var(--fg-faint);">
                    — × —
                </div>
                @endif

                {{-- Status chip --}}
                <div style="margin-top: 14px;">
                    @if($jogo->estaEncerrado())
                    <span class="chip green">
                        <span class="material-symbols-outlined" style="font-size: 12px;">check_circle</span>
                        Encerrado
                    </span>
                    @elseif($jogo->estaAberto())
                    <span class="chip yellow">
                        <span class="material-symbols-outlined" style="font-size: 12px;">pending</span>
                        Palpites abertos
                    </span>
                    @else
                    <span class="chip">
                        <span class="material-symbols-outlined" style="font-size: 12px;">schedule</span>
                        Agendado
                    </span>
                    @endif
                </div>
            </div>

            {{-- Adversário --}}
            <div style="display: flex; flex-direction: column; align-items: center; gap: 10px; flex: 0 0 auto;">
                <img src="{{ $jogo->foto_url }}" alt="{{ $jogo->adversario ?? '???' }}"
                     style="width: 100px; height: 70px; border-radius: 8px; object-fit: contain; background: var(--bg-elev-2); border: 1px solid var(--border-medium); box-shadow: 0 8px 24px rgba(0,0,0,0.45);" />
                <span style="font: 800 15px/1 Inter; letter-spacing: .06em; color: #fff; text-transform: uppercase;">{{ $jogo->adversario ?? '???' }}</span>
            </div>
        </div>
    </div>

    {{-- ===================== PROGRESSO DE PARTICIPAÇÃO ===================== --}}
    @if($jogo->estaAberto())
    <div class="card" style="padding: 20px 24px; margin-bottom: 24px; display: flex; align-items: center; gap: 20px;">
        <span class="material-symbols-outlined" style="font-size: 20px; color: var(--br-yellow); flex-shrink: 0;">groups</span>
        <div style="flex: 1; min-width: 0;">
            <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 8px;">
                <span style="font: 600 13px/1 Inter; color: #fff;">Participação</span>
                <span style="font: 700 13px/1 Inter; font-variant-numeric: tabular-nums; color: var(--fg-secondary);">
                    {{ $totalPalpites }} de {{ $totalAtivos }} participantes apostaram
                </span>
            </div>
            @php $pct = $totalAtivos > 0 ? round(($totalPalpites / $totalAtivos) * 100) : 0; @endphp
            <div style="height: 6px; border-radius: 99px; background: rgba(255,255,255,0.06); overflow: hidden;">
                <div style="height: 100%; width: {{ $pct }}%; border-radius: 99px; background: var(--grad-green); transition: width .5s var(--ease);"></div>
            </div>
        </div>
        @if(!$revelado)
        <div style="text-align: right; flex-shrink: 0;">
            <div style="font: 600 11px/1 Inter; letter-spacing: .10em; text-transform: uppercase; color: var(--fg-muted);">Revelação</div>
            <div style="font: 500 12px/1.4 Inter; color: var(--fg-secondary); margin-top: 5px;">
                @if($totalPalpites >= $totalAtivos) Logo logo @else Após todos apostarem @endif
            </div>
        </div>
        @endif
    </div>
    @endif

    {{-- ===================== COMPONENTE DE PALPITE ===================== --}}
    @auth
    <div style="margin-bottom: 24px;">
        <livewire:faz-palpite :jogo="$jogo" />
    </div>
    @endauth

    {{-- ===================== PALPITES REVELADOS ===================== --}}
    @if($revelado && $palpites->isNotEmpty())
    @php
        $total = $palpites->count();
        $vitorias  = $palpites->filter(fn($p) => $p->gols_brasil > $p->gols_adversario)->count();
        $empates   = $palpites->filter(fn($p) => $p->gols_brasil === $p->gols_adversario)->count();
        $derrotas  = $palpites->filter(fn($p) => $p->gols_brasil < $p->gols_adversario)->count();
        $pctVit    = $total > 0 ? round($vitorias / $total * 100) : 0;
        $pctEmp    = $total > 0 ? round($empates  / $total * 100) : 0;
        $pctDer    = $total > 0 ? round($derrotas / $total * 100) : 0;
    @endphp
    <div class="card" style="padding: 18px 22px; margin-bottom: 20px; display: flex; flex-wrap: wrap; gap: 20px; align-items: center;">
        <div style="font: 600 11px/1 Inter; letter-spacing: .12em; text-transform: uppercase; color: var(--fg-muted); flex-shrink: 0;">O que o grupo apostou:</div>
        <div style="flex: 1; display: flex; gap: 16px; flex-wrap: wrap;">
            @foreach([
                [$pctVit, $vitorias, 'Vitória BRA', '#62F49B', 'rgba(31,214,107,0.20)'],
                [$pctEmp, $empates,  'Empate',       '#FEDF00', 'rgba(254,223,0,0.15)'],
                [$pctDer, $derrotas, 'Derrota BRA',  '#FF7A8E', 'rgba(255,77,106,0.15)'],
            ] as [$pct, $qtd, $label, $cor, $bg])
            <div style="display: flex; align-items: center; gap: 8px;">
                <div style="width: 36px; height: 36px; border-radius: var(--r-md); background: {{ $bg }}; display: flex; align-items: center; justify-content: center; font: 800 14px/1 Inter; color: {{ $cor }};">{{ $pct }}%</div>
                <div>
                    <div style="font: 700 12px/1 Inter; color: #fff;">{{ $label }}</div>
                    <div style="font: 500 11px/1 Inter; color: var(--fg-muted); margin-top: 3px;">{{ $qtd }} palpite{{ $qtd !== 1 ? 's' : '' }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div>
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
            <div>
                <div style="font: 600 11px/1 Inter; letter-spacing: .16em; text-transform: uppercase; color: var(--br-yellow); margin-bottom: 8px; display: inline-flex; gap: 6px; align-items: center;">
                    <span class="material-symbols-outlined" style="font-size: 13px;">lock_open</span>
                    Palpites revelados
                </div>
                <h2 style="margin: 0; font: 700 20px/1 Inter; letter-spacing: -0.01em; color: #fff;">O que todo mundo apostou</h2>
            </div>
            <span class="chip green">{{ $palpites->count() }} palpites</span>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(170px, 1fr)); gap: 12px;">
            @foreach($palpites as $palpite)
            @php
                $encerrado = $jogo->estaEncerrado() && $palpite->pontuacao !== null;
                if ($encerrado) {
                    if ($palpite->pts_exato) {
                        $cardBg = 'linear-gradient(180deg, #0D2B1A 0%, #051509 100%)';
                        $cardBorder = 'rgba(31,214,107,0.35)';
                        $scoreColor = '#62F49B';
                        $badgeColor = '#62F49B';
                        $badgeBg = 'rgba(31,214,107,0.12)';
                        $badgeLabel = 'Exato';
                        $badgeIcon = 'gps_fixed';
                    } elseif ($palpite->pts_ganhador) {
                        $cardBg = 'linear-gradient(180deg, #2B2500 0%, #1A1500 100%)';
                        $cardBorder = 'rgba(254,223,0,0.30)';
                        $scoreColor = '#FEDF00';
                        $badgeColor = '#FEDF00';
                        $badgeBg = 'rgba(254,223,0,0.10)';
                        $badgeLabel = 'Ganhador';
                        $badgeIcon = 'flag_circle';
                    } elseif ($palpite->pts_parcial) {
                        $cardBg = 'linear-gradient(180deg, #0D1530 0%, #070D20 100%)';
                        $cardBorder = 'rgba(91,130,255,0.30)';
                        $scoreColor = '#8EA9FF';
                        $badgeColor = '#8EA9FF';
                        $badgeBg = 'rgba(91,130,255,0.12)';
                        $badgeLabel = 'Parcial';
                        $badgeIcon = 'percent';
                    } else {
                        $cardBg = 'var(--bg-elev-0)';
                        $cardBorder = 'var(--border-soft)';
                        $scoreColor = 'var(--fg-muted)';
                        $badgeColor = 'var(--fg-muted)';
                        $badgeBg = 'rgba(255,255,255,0.04)';
                        $badgeLabel = 'Errou';
                        $badgeIcon = 'close';
                    }
                } else {
                    $cardBg = 'var(--bg-elev-0)';
                    $cardBorder = 'var(--border-medium)';
                    $scoreColor = '#fff';
                    $badgeColor = null;
                    $badgeLabel = null;
                    $badgeIcon = null;
                    $badgeBg = null;
                }
            @endphp
            <div style="background: {{ $cardBg }}; border: 1px solid {{ $cardBorder }}; border-radius: var(--r-xl); padding: 18px 16px; text-align: center; transition: transform var(--dur) var(--ease);">

                {{-- Avatar + nome --}}
                <div style="display: flex; flex-direction: column; align-items: center; gap: 8px; margin-bottom: 14px;">
                    <div style="width: 38px; height: 38px; border-radius: 50%; background: linear-gradient(135deg, #1FD66B 0%, #002776 100%); display: flex; align-items: center; justify-content: center; font: 700 13px/1 Inter; color: #fff; flex-shrink: 0;">
                        {{ strtoupper(substr($palpite->usuario->nome ?? '?', 0, 2)) }}
                    </div>
                    <span style="font: 600 12px/1.3 Inter; color: var(--fg-secondary); max-width: 130px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                        {{ $palpite->usuario->nome ?? 'Usuário' }}
                    </span>
                </div>

                {{-- Placar --}}
                <div style="font: 900 42px/1 Inter; font-variant-numeric: tabular-nums; letter-spacing: -0.04em; color: {{ $scoreColor }}; margin-bottom: 10px;">
                    {{ $palpite->gols_brasil }}<span style="font-size: 26px; color: var(--fg-faint); letter-spacing: -0.01em;">×</span>{{ $palpite->gols_adversario }}
                </div>

                {{-- Badge resultado --}}
                @if($encerrado && $badgeLabel)
                <div style="display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px; border-radius: var(--r-pill); background: {{ $badgeBg }}; border: 1px solid {{ $cardBorder }}; font: 700 10px/1 Inter; letter-spacing: .10em; text-transform: uppercase; color: {{ $badgeColor }};">
                    <span class="material-symbols-outlined" style="font-size: 11px;">{{ $badgeIcon }}</span>
                    {{ $badgeLabel }}
                </div>
                @elseif($encerrado)
                <div style="display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px; border-radius: var(--r-pill); background: rgba(255,255,255,0.04); border: 1px solid var(--border-soft); font: 700 10px/1 Inter; letter-spacing: .10em; text-transform: uppercase; color: var(--fg-muted);">
                    <span class="material-symbols-outlined" style="font-size: 11px;">close</span>
                    Errou
                </div>
                @endif

                {{-- Pontuação --}}
                @if($encerrado && $palpite->pontuacao !== null)
                <div style="margin-top: 8px; font: 800 13px/1 Inter; color: {{ $scoreColor }};">
                    +{{ number_format($palpite->pontuacao, 1) }} pts
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>

    {{-- Sem revelação ainda --}}
    @elseif($jogo->estaAberto() && !$revelado)
    <div class="card" style="padding: 40px; text-align: center;">
        <div style="width: 60px; height: 60px; border-radius: var(--r-lg); background: rgba(254,223,0,0.10); border: 1px solid rgba(254,223,0,0.25); display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px;">
            <span class="material-symbols-outlined" style="font-size: 30px; color: var(--br-yellow);">lock</span>
        </div>
        <h3 style="margin: 0 0 8px; font: 700 18px/1.2 Inter; color: #fff;">Palpites ocultos</h3>
        <p style="margin: 0; font: 500 14px/1.55 Inter; color: var(--fg-muted); max-width: 380px; margin-inline: auto;">
            Os palpites ficarão visíveis para todos após o apito inicial ou quando todos os participantes tiverem apostado.
        </p>
    </div>
    @endif

</div>
