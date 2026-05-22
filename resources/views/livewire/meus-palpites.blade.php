<div style="padding: 28px 32px 56px; max-width: 960px; margin: 0 auto;">
    <div style="margin-bottom: 28px;">
        <div style="font: 600 11px/1 Inter; letter-spacing: .16em; text-transform: uppercase; color: var(--br-yellow); margin-bottom: 10px; display: inline-flex; gap: 6px; align-items: center;">
            <span class="material-symbols-outlined" style="font-size: 13px;">emoji_events</span>
            Bolão Innovate
        </div>
        <h1 style="margin: 0; font: 800 28px/1.1 Inter; letter-spacing: -0.02em; color: #fff;">Meus palpites</h1>
        <p style="margin: 8px 0 0; font: 500 13.5px/1.5 Inter; color: var(--fg-secondary);">
            Histórico completo — {{ $palpites->count() }} palpite{{ $palpites->count() !== 1 ? 's' : '' }} registrado{{ $palpites->count() !== 1 ? 's' : '' }}
        </p>
    </div>

    @if($palpites->isEmpty())
    <div class="card" style="padding: 56px 32px; text-align: center;">
        <span class="material-symbols-outlined" style="font-size: 52px; color: var(--fg-faint);">sports_soccer</span>
        <h3 style="margin: 20px 0 8px; font: 700 18px/1.2 Inter; color: #fff;">Nenhum palpite ainda</h3>
        <p style="margin: 0; font: 500 14px/1.55 Inter; color: var(--fg-muted);">Você ainda não registrou palpites. Aguarde um jogo ser aberto.</p>
        <a href="{{ route('dashboard') }}" class="btn-primary" style="display: inline-flex; margin-top: 24px; text-decoration: none;">
            <span class="material-symbols-outlined" style="font-size: 17px;">home</span>
            Ir para o dashboard
        </a>
    </div>
    @else

    {{-- Resumo de pontuação --}}
    @php
        $totalPts    = $palpites->sum('pontuacao');
        $qtdExatos   = $palpites->where('pts_exato', true)->count();
        $qtdGanhs    = $palpites->where('pts_ganhador', true)->count();
        $qtdParc     = $palpites->where('pts_parcial', true)->count();
        $calculados  = $palpites->whereNotNull('pontuacao')->count();
    @endphp

    @if($calculados > 0)
    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-bottom: 24px;">
        @foreach([
            ['pts', number_format($totalPts, 1), 'pts', '#FFD96B', 'rgba(242,201,76,0.10)', 'rgba(242,201,76,0.30)', 'scoreboard'],
            ['exatos', $qtdExatos, 'exatos', '#62F49B', 'rgba(31,214,107,0.10)', 'rgba(31,214,107,0.30)', 'gps_fixed'],
            ['ganhs', $qtdGanhs, 'ganhadores', '#FEDF00', 'rgba(254,223,0,0.10)', 'rgba(254,223,0,0.30)', 'flag_circle'],
            ['parcs', $qtdParc, 'parciais', '#8EA9FF', 'rgba(91,130,255,0.10)', 'rgba(91,130,255,0.30)', 'percent'],
        ] as [$key, $val, $label, $color, $bg, $border, $icon])
        <div class="card" style="padding: 18px 20px; border-color: {{ $border }}; background: {{ $bg }}; display: flex; align-items: center; gap: 14px;">
            <div style="width: 40px; height: 40px; border-radius: var(--r-md); background: {{ $bg }}; border: 1px solid {{ $border }}; display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 20px; color: {{ $color }};">{{ $icon }}</span>
            </div>
            <div>
                <div style="font: 800 24px/1 Inter; font-variant-numeric: tabular-nums; color: {{ $color }};">{{ $val }}</div>
                <div style="font: 500 11.5px/1 Inter; color: var(--fg-muted); margin-top: 5px; letter-spacing: .06em;">{{ $label }}</div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    {{-- Lista de palpites --}}
    <div class="card card-scroll" style="padding: 0; border-radius: var(--r-2xl); overflow: hidden;">
        <div class="tbl-row" style="grid-template-columns: 1fr 120px 120px 160px; padding: 12px 24px; background: rgba(255,255,255,0.02); font: 600 10.5px/1 Inter; letter-spacing: .12em; text-transform: uppercase; color: var(--fg-muted); border-bottom: 1px solid var(--border-medium);">
            <div>Jogo</div>
            <div style="text-align: center;">Meu palpite</div>
            <div style="text-align: center;">Resultado</div>
            <div style="text-align: right;">Pontuação</div>
        </div>

        @foreach($palpites as $palpite)
        @php
            $jogo = $palpite->jogo;
            $calculado = $palpite->pontuacao !== null;

            if ($calculado) {
                if ($palpite->pts_exato) {
                    $cor = '#62F49B'; $chipClass = 'green'; $chipLabel = 'Exato'; $chipIcon = 'gps_fixed';
                } elseif ($palpite->pts_ganhador && $palpite->pts_parcial) {
                    $cor = '#FEDF00'; $chipClass = 'yellow'; $chipLabel = 'Ganhador + Parcial'; $chipIcon = 'flag_circle';
                } elseif ($palpite->pts_ganhador) {
                    $cor = '#FEDF00'; $chipClass = 'yellow'; $chipLabel = 'Ganhador'; $chipIcon = 'flag_circle';
                } elseif ($palpite->pts_parcial) {
                    $cor = '#8EA9FF'; $chipClass = 'navy'; $chipLabel = 'Parcial'; $chipIcon = 'percent';
                } else {
                    $cor = 'var(--fg-muted)'; $chipClass = ''; $chipLabel = 'Zerou'; $chipIcon = 'close';
                }
            } else {
                $cor = '#fff';
                $chipClass = $jogo?->estaEncerrado() ? '' : 'yellow';
                $chipLabel = $jogo?->estaEncerrado() ? 'Aguardando' : 'Em andamento';
                $chipIcon = $jogo?->estaEncerrado() ? 'hourglass_empty' : 'pending';
            }
        @endphp
        <div class="tbl-row" style="grid-template-columns: 1fr 120px 120px 160px; padding: 14px 24px;">
            {{-- Jogo --}}
            <div>
                <div style="font: 600 14px/1 Inter; color: #fff;">
                    Brasil × {{ $jogo?->adversario ?? '???' }}
                </div>
                <div style="display: flex; gap: 8px; align-items: center; margin-top: 6px;">
                    <span class="chip" style="height: 20px; font-size: 10px;">{{ \App\Models\Jogo::FASES[$jogo?->fase] ?? ucfirst($jogo?->fase ?? '—') }}</span>
                    @if($jogo?->data_hora)
                    <span style="font: 500 11.5px/1 Inter; color: var(--fg-muted);">{{ $jogo->data_hora->format('d/m/Y') }}</span>
                    @endif
                </div>
            </div>

            {{-- Meu palpite --}}
            <div style="text-align: center; font: 800 20px/1 Inter; font-variant-numeric: tabular-nums; letter-spacing: -0.02em; color: #fff;">
                {{ $palpite->gols_brasil }}<span style="color: var(--fg-faint); font-size: 14px; letter-spacing: 0;">×</span>{{ $palpite->gols_adversario }}
            </div>

            {{-- Resultado oficial --}}
            <div style="text-align: center;">
                @if($jogo?->estaEncerrado() && $jogo->gols_brasil !== null)
                <span style="font: 800 20px/1 Inter; font-variant-numeric: tabular-nums; letter-spacing: -0.02em; color: {{ $cor }};">
                    {{ $jogo->gols_brasil }}<span style="color: var(--fg-faint); font-size: 14px; letter-spacing: 0;">×</span>{{ $jogo->gols_adversario }}
                </span>
                @else
                <span style="font: 500 13px/1 Inter; color: var(--fg-muted);">—</span>
                @endif
            </div>

            {{-- Pontuação / status --}}
            <div style="text-align: right; display: flex; align-items: center; justify-content: flex-end; gap: 8px;">
                @if($calculado)
                <span class="chip {{ $chipClass }}" style="height: 22px; font-size: 10.5px;">
                    <span class="material-symbols-outlined" style="font-size: 11px;">{{ $chipIcon }}</span>
                    {{ $chipLabel }}
                </span>
                <span style="font: 800 18px/1 Inter; font-variant-numeric: tabular-nums; color: {{ $cor }}; min-width: 44px; text-align: right;">
                    {{ $palpite->pontuacao > 0 ? '+' : '' }}{{ number_format($palpite->pontuacao, 1) }}
                </span>
                @else
                <span class="chip {{ $chipClass }}" style="height: 22px; font-size: 10.5px;">
                    <span class="material-symbols-outlined" style="font-size: 11px;">{{ $chipIcon }}</span>
                    {{ $chipLabel }}
                </span>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    @endif
</div>
