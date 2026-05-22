<div style="padding: 28px 24px 56px; max-width: 860px; margin: 0 auto;">
    <div style="margin-bottom: 24px;">
        <div style="font: 600 11px/1 Inter; letter-spacing: .16em; text-transform: uppercase; color: var(--br-yellow); margin-bottom: 10px; display: inline-flex; gap: 6px; align-items: center;">
            <span class="material-symbols-outlined" style="font-size: 13px;">sports_soccer</span>
            Calendário
        </div>
        <h1 style="margin: 0; font: 800 28px/1.1 Inter; letter-spacing: -0.02em; color: #fff;">Jogos do Brasil</h1>
    </div>

    <div style="display: flex; flex-direction: column; gap: 12px;">
        @forelse($jogos as $jogo)
        @php
            $encerrado = $jogo->estaEncerrado();
            $aberto    = $jogo->estaAberto();
        @endphp
        <div class="card" style="padding: 0; border-radius: var(--r-xl); overflow: hidden; {{ $aberto ? 'border-color: rgba(254,223,0,0.30);' : '' }}">
            <div style="display: flex; align-items: center; gap: 20px; padding: 18px 22px;">

                {{-- Fase --}}
                <div style="flex-shrink: 0; width: 80px; text-align: center;">
                    @php $faseLabel = \App\Models\Jogo::FASES[$jogo->fase] ?? ucfirst($jogo->fase); @endphp
                    <span class="chip" style="font-size: 10px;">{{ $faseLabel }}</span>
                    @if($jogo->data_hora)
                    <div style="font: 500 11px/1.3 Inter; color: var(--fg-muted); margin-top: 6px;">{{ $jogo->data_hora->format('d/m H:i') }}</div>
                    @endif
                </div>

                <div style="width: 1px; height: 40px; background: var(--border-soft); flex-shrink: 0;"></div>

                {{-- Confronto --}}
                <div style="flex: 1; display: flex; align-items: center; gap: 14px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <svg width="40" height="28" viewBox="0 0 80 56" style="border-radius: 3px; flex-shrink: 0;">
                            <rect width="80" height="56" fill="#009C3B"/>
                            <path d="M40 6 L74 28 L40 50 L6 28 Z" fill="#FEDF00"/>
                            <circle cx="40" cy="28" r="11" fill="#002776"/>
                        </svg>
                        <span style="font: 700 14px/1 Inter; color: #fff;">Brasil</span>
                    </div>

                    @if($encerrado && $jogo->gols_brasil !== null)
                    <div style="font: 900 28px/1 Inter; font-variant-numeric: tabular-nums; letter-spacing: -0.04em; color: var(--br-yellow); padding: 0 12px;">
                        {{ $jogo->gols_brasil }} × {{ $jogo->gols_adversario }}
                    </div>
                    @else
                    <div style="font: 700 16px/1 Inter; color: var(--fg-faint); padding: 0 12px;">VS</div>
                    @endif

                    <div style="display: flex; align-items: center; gap: 10px;">
                        <img src="{{ $jogo->foto_url }}" alt="{{ $jogo->adversario ?? '???' }}"
                             style="width: 40px; height: 28px; border-radius: 3px; object-fit: contain; background: var(--bg-elev-1); flex-shrink: 0;" />
                        <span style="font: 700 14px/1 Inter; color: #fff;">{{ $jogo->adversario ?? '???' }}</span>
                    </div>
                </div>

                {{-- Status + CTA --}}
                <div style="flex-shrink: 0; display: flex; align-items: center; gap: 10px;">
                    @if($aberto)
                    <a href="{{ route('jogos.show', $jogo) }}" class="btn-gold" style="height: 38px; font-size: 13px; text-decoration: none;">
                        <span class="material-symbols-outlined" style="font-size: 16px;">edit_note</span>
                        Apostar
                    </a>
                    @elseif($encerrado)
                    <a href="{{ route('jogos.show', $jogo) }}" class="btn-ghost" style="height: 38px; font-size: 13px; text-decoration: none;">
                        <span class="material-symbols-outlined" style="font-size: 16px;">visibility</span>
                        Ver palpites
                    </a>
                    @else
                    <span class="chip">
                        <span class="material-symbols-outlined" style="font-size: 12px;">schedule</span>
                        Agendado
                    </span>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="card" style="padding: 48px 24px; text-align: center;">
            <span class="material-symbols-outlined" style="font-size: 48px; color: var(--fg-faint);">sports_soccer</span>
            <p style="margin: 16px 0 0; font: 500 14px/1.5 Inter; color: var(--fg-muted);">Nenhum jogo cadastrado ainda.</p>
        </div>
        @endforelse
    </div>
</div>
