<div style="position: relative;">

    {{-- ===================== JÁ APOSTOU ===================== --}}
    @if($meuPalpite)
    <div class="card" style="padding: 32px; border-radius: var(--r-2xl); background: linear-gradient(180deg, #0E1A4A 0%, #07102C 100%); text-align: center;">
        <div style="display: inline-flex; gap: 8px; align-items: center; padding: 6px 14px; border-radius: var(--r-pill); background: rgba(31,214,107,0.12); border: 1px solid rgba(31,214,107,0.35); font: 700 11px/1 Inter; letter-spacing: .14em; text-transform: uppercase; color: #62F49B; margin-bottom: 20px;">
            <span class="material-symbols-outlined" style="font-size: 14px;">check_circle</span>
            Palpite registrado
        </div>
        <p style="font: 500 14px/1.5 Inter; color: var(--fg-muted); margin: 0 0 24px;">Seu palpite foi registrado e não pode ser alterado.</p>
        <div style="display: inline-flex; align-items: center; gap: 24px; padding: 20px 40px; background: rgba(0,0,0,0.30); border: 1px solid var(--border-medium); border-radius: var(--r-xl);">
            <div style="display: flex; flex-direction: column; align-items: center; gap: 6px;">
                <img src="{{ asset('images/bandeira-brasil.png') }}" alt="Brasil"
                     style="width: 56px; height: 40px; border-radius: 4px; object-fit: contain;" />
                <span style="font: 700 13px/1 Inter; color: #fff;">Brasil</span>
            </div>
            <div style="font: 900 52px/1 Inter; letter-spacing: -0.04em; font-variant-numeric: tabular-nums; color: var(--br-yellow);">
                {{ $meuPalpite->gols_brasil }} <span style="color: var(--fg-faint); font-size: 32px;">×</span> {{ $meuPalpite->gols_adversario }}
            </div>
            <div style="display: flex; flex-direction: column; align-items: center; gap: 6px;">
                <img src="{{ $jogo->foto_url }}" alt="{{ $jogo->adversario ?? '???' }}"
                     style="width: 56px; height: 40px; border-radius: 4px; object-fit: contain; background: var(--bg-elev-1); border: 1px solid var(--border-soft);" />
                <span style="font: 700 13px/1 Inter; color: #fff;">{{ $jogo->adversario }}</span>
            </div>
        </div>

        @if($meuPalpite->pontuacao !== null)
        <div style="margin-top: 20px; display: inline-flex; gap: 16px;">
            @if($meuPalpite->pts_exato)
            <span class="chip green"><span class="material-symbols-outlined" style="font-size: 13px;">gps_fixed</span> Exato · +3 pts</span>
            @elseif($meuPalpite->pts_ganhador)
            <span class="chip yellow"><span class="material-symbols-outlined" style="font-size: 13px;">flag_circle</span> Ganhador · +1,5 pts</span>
            @endif
            @if($meuPalpite->pts_parcial)
            <span class="chip navy"><span class="material-symbols-outlined" style="font-size: 13px;">percent</span> Parcial · +0,5 pts</span>
            @endif
            <span class="chip gold"><span class="material-symbols-outlined" style="font-size: 13px;">scoreboard</span> Total: {{ number_format($meuPalpite->pontuacao, 1) }} pts</span>
        </div>
        @endif
    </div>

    {{-- ===================== BLOQUEADO ===================== --}}
    @elseif(!$pode)
    <div class="card" style="padding: 32px; border-radius: var(--r-2xl); text-align: center;">
        <span class="material-symbols-outlined" style="font-size: 40px; color: var(--fg-muted);">lock</span>
        <p style="font: 600 16px/1.4 Inter; color: #fff; margin: 16px 0 8px;">Palpite indisponível</p>
        <p style="font: 500 14px/1.5 Inter; color: var(--fg-muted); margin: 0;">{{ $motivoBloqueio }}</p>
    </div>

    {{-- ===================== FORMULÁRIO ===================== --}}
    @else

    @error('geral')
    <div style="margin-bottom: 16px; padding: 12px 16px; border-radius: var(--r-md); background: rgba(255,77,106,0.10); border: 1px solid rgba(255,77,106,0.35); display: flex; gap: 10px; align-items: center;">
        <span class="material-symbols-outlined" style="font-size: 16px; color: #FF7A8E;">error</span>
        <span style="font: 500 13px/1 Inter; color: var(--fg-secondary);">{{ $message }}</span>
    </div>
    @enderror

    <div class="card" style="padding: 40px 48px 48px; border-radius: var(--r-2xl); background: linear-gradient(180deg, #0E1A4A 0%, #07102C 100%); position: relative; overflow: hidden;">
        {{-- Linha do meio-campo decorativa --}}
        <svg width="100%" height="100%" viewBox="0 0 1100 520" preserveAspectRatio="none"
             style="position: absolute; inset: 0; opacity: .4; pointer-events: none;">
            <line x1="550" y1="40" x2="550" y2="480" stroke="rgba(255,255,255,0.06)" stroke-width="1"/>
            <circle cx="550" cy="260" r="80" stroke="rgba(255,255,255,0.06)" stroke-width="1" fill="none"/>
        </svg>

        <div style="text-align: center; margin-bottom: 30px; position: relative;">
            <div style="display: inline-flex; gap: 8px; align-items: center; padding: 6px 14px; border-radius: var(--r-pill); background: rgba(254,223,0,0.10); border: 1px solid rgba(254,223,0,0.30); font: 700 11px/1 Inter; letter-spacing: .16em; text-transform: uppercase; color: var(--br-yellow);">
                <span class="material-symbols-outlined" style="font-size: 14px;">edit</span>
                Registre seu palpite
            </div>
            <h2 style="margin: 14px 0 6px; font: 800 28px/1.15 Inter; letter-spacing: -0.02em; color: #fff;">Qual vai ser o placar?</h2>
            <p style="margin: 0; font: 500 13.5px/1.5 Inter; color: var(--fg-muted); max-width: 460px; margin-inline: auto;">
                Use os botões abaixo de cada time pra ajustar o placar.<br>
                Após a confirmação, o palpite <strong style="color: #fff;">não pode ser alterado</strong>.
            </p>
        </div>

        {{-- Scoreboard --}}
        <div class="scoreboard-grid" style="display: grid; grid-template-columns: 1fr auto 1fr; gap: 32px; align-items: center; padding: 8px 40px 0; position: relative;">

            {{-- Brasil --}}
            <div style="display: flex; flex-direction: column; align-items: center; gap: 24px;">
                <div style="display: flex; flex-direction: column; align-items: center; gap: 12px;">
                    <img src="{{ asset('images/bandeira-brasil.png') }}" alt="Brasil"
                         style="width: 88px; height: 62px; border-radius: 6px; object-fit: contain; box-shadow: 0 6px 18px rgba(0,0,0,0.35);" />
                    <div style="text-align: center;">
                        <div style="font: 900 32px/1 Inter; letter-spacing: -0.04em; color: #fff;">BRA</div>
                        <div style="font: 500 11px/1 Inter; color: var(--fg-muted); margin-top: 6px; letter-spacing: .10em;">BRASIL</div>
                    </div>
                </div>

                {{-- Display placar Brasil --}}
                <div class="score-box" style="position: relative; width: 180px; height: 200px; border-radius: 20px; background: linear-gradient(180deg, #04081C 0%, #0A1131 100%); border: 2px solid rgba(255,255,255,0.10); box-shadow: 0 30px 60px rgba(0,0,0,0.55), 0 0 80px rgba(31,214,107,0.15), inset 0 2px 0 rgba(255,255,255,0.06); display: flex; align-items: center; justify-content: center; overflow: hidden;">
                    <div style="position: absolute; inset: 0; background-image: repeating-linear-gradient(0deg, rgba(255,255,255,0.02) 0 1px, transparent 1px 4px); pointer-events: none;"></div>
                    <div style="position: absolute; top: 10px; left: 12px; font: 700 9px/1 Inter; letter-spacing: .14em; text-transform: uppercase; color: var(--fg-muted);">CASA</div>
                    <div style="position: absolute; top: 10px; right: 12px; width: 7px; height: 7px; border-radius: 99px; background: #1FD66B; box-shadow: 0 0 12px #1FD66B;"></div>
                    <span class="score-digit-xl" style="font: 900 140px/1 Inter; font-variant-numeric: tabular-nums; letter-spacing: -0.04em; color: #1FD66B; text-shadow: 0 4px 0 rgba(0,0,0,0.4), 0 0 32px rgba(31,214,107,0.40);">{{ $golsBrasil }}</span>
                </div>

                <div style="display: flex; gap: 12px;">
                    <button wire:click="decrementar('brasil')" style="width: 52px; height: 52px; border-radius: var(--r-pill); background: rgba(255,255,255,0.04); border: 1px solid var(--border-medium); color: #fff; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; transition: all .2s var(--ease);">
                        <span class="material-symbols-outlined" style="font-size: 24px;">remove</span>
                    </button>
                    <button wire:click="incrementar('brasil')" style="width: 52px; height: 52px; border-radius: var(--r-pill); background: var(--grad-green-flat); border: 1px solid rgba(31,214,107,0.50); color: #fff; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; box-shadow: 0 8px 20px rgba(0,156,59,0.40), 0 1px 0 rgba(255,255,255,0.25) inset;">
                        <span class="material-symbols-outlined" style="font-size: 24px;">add</span>
                    </button>
                </div>
            </div>

            {{-- Separador --}}
            <div style="display: flex; flex-direction: column; align-items: center; gap: 14px;">
                <span style="font: 900 52px/1 Inter; letter-spacing: -0.06em; color: var(--fg-faint);">×</span>
                <div style="width: 56px; height: 56px; border-radius: var(--r-pill); background: rgba(254,223,0,0.10); border: 1px solid rgba(254,223,0,0.30); display: inline-flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined ms-fill" style="font-size: 28px; color: var(--br-yellow);">sports_soccer</span>
                </div>
            </div>

            {{-- Adversário --}}
            <div style="display: flex; flex-direction: column; align-items: center; gap: 24px;">
                <div style="display: flex; flex-direction: column; align-items: center; gap: 12px;">
                    <img src="{{ $jogo->foto_url }}" alt="{{ $jogo->adversario ?? '???' }}"
                         style="width: 88px; height: 62px; border-radius: 6px; object-fit: contain; background: var(--bg-elev-1); border: 1px solid var(--border-medium);" />
                    <div style="text-align: center;">
                        <div style="font: 900 26px/1 Inter; letter-spacing: -0.03em; color: #fff;">{{ strtoupper(substr($jogo->adversario, 0, 3)) }}</div>
                        <div style="font: 500 11px/1 Inter; color: var(--fg-muted); margin-top: 6px; letter-spacing: .10em;">{{ strtoupper($jogo->adversario) }}</div>
                    </div>
                </div>

                {{-- Display placar adversário --}}
                <div class="score-box" style="position: relative; width: 180px; height: 200px; border-radius: 20px; background: linear-gradient(180deg, #04081C 0%, #0A1131 100%); border: 2px solid rgba(255,255,255,0.10); box-shadow: 0 30px 60px rgba(0,0,0,0.55), 0 0 80px rgba(255,122,142,0.12), inset 0 2px 0 rgba(255,255,255,0.06); display: flex; align-items: center; justify-content: center; overflow: hidden;">
                    <div style="position: absolute; inset: 0; background-image: repeating-linear-gradient(0deg, rgba(255,255,255,0.02) 0 1px, transparent 1px 4px); pointer-events: none;"></div>
                    <div style="position: absolute; top: 10px; left: 12px; font: 700 9px/1 Inter; letter-spacing: .14em; text-transform: uppercase; color: var(--fg-muted);">VISITANTE</div>
                    <div style="position: absolute; top: 10px; right: 12px; width: 7px; height: 7px; border-radius: 99px; background: #FF7A8E; box-shadow: 0 0 12px #FF7A8E;"></div>
                    <span class="score-digit-xl" style="font: 900 140px/1 Inter; font-variant-numeric: tabular-nums; letter-spacing: -0.04em; color: #FF7A8E; text-shadow: 0 4px 0 rgba(0,0,0,0.4), 0 0 32px rgba(255,122,142,0.35);">{{ $golsAdversario }}</span>
                </div>

                <div style="display: flex; gap: 12px;">
                    <button wire:click="decrementar('adversario')" style="width: 52px; height: 52px; border-radius: var(--r-pill); background: rgba(255,255,255,0.04); border: 1px solid var(--border-medium); color: #fff; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;">
                        <span class="material-symbols-outlined" style="font-size: 24px;">remove</span>
                    </button>
                    <button wire:click="incrementar('adversario')" style="width: 52px; height: 52px; border-radius: var(--r-pill); background: var(--grad-green-flat); border: 1px solid rgba(31,214,107,0.50); color: #fff; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; box-shadow: 0 8px 20px rgba(0,156,59,0.40), 0 1px 0 rgba(255,255,255,0.25) inset;">
                        <span class="material-symbols-outlined" style="font-size: 24px;">add</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Resumo + botão confirmar --}}
        <div class="bet-summary" style="margin-top: 36px; padding: 18px 24px; border-radius: var(--r-lg); background: rgba(0,0,0,0.30); border: 1px solid var(--border-medium); display: flex; align-items: center; justify-content: space-between;">
            <div style="display: flex; align-items: center; gap: 14px;">
                <span class="material-symbols-outlined" style="font-size: 22px; color: var(--br-yellow);">auto_awesome</span>
                <div>
                    <div style="font: 600 11px/1 Inter; letter-spacing: .12em; text-transform: uppercase; color: var(--fg-muted); margin-bottom: 6px;">Seu palpite</div>
                    <div style="font: 700 16px/1 Inter; color: #fff;">
                        Brasil <span style="color: var(--br-yellow);">{{ $golsBrasil }}</span> × <span style="color: var(--br-yellow);">{{ $golsAdversario }}</span> {{ $jogo->adversario }}
                        <span style="margin-left: 10px; font: 500 13px/1 Inter; color: var(--fg-secondary);">
                            @if($golsBrasil > $golsAdversario) · Brasil vence
                            @elseif($golsBrasil < $golsAdversario) · {{ $jogo->adversario }} vence
                            @else · Empate
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            <button wire:click="abrirModal" wire:loading.attr="disabled" wire:target="abrirModal" class="btn-gold" style="height: 48px;">
                <span wire:loading.remove wire:target="abrirModal">Confirmar Palpite</span>
                <span wire:loading wire:target="abrirModal" style="display:none">Validando...</span>
                <span class="material-symbols-outlined" style="font-size: 18px;">arrow_forward</span>
            </button>
        </div>
    </div>

    {{-- Regras de pontuação --}}
    <div class="rules-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-top: 16px;">
        @foreach([
            ['gps_fixed',    'Placar exato',    '3 pts',   '#62F49B', 'Acertou os dois gols'],
            ['flag_circle',  'Ganhador certo',  '1,5 pts', '#FEDF00', 'Acertou quem vence'],
            ['percent',      'Gols parciais',   '0,5 pts', '#8EA9FF', 'Acertou gols de 1 time'],
        ] as [$icon, $titulo, $pts, $color, $desc])
        <div class="card" style="padding: 18px 20px; display: flex; align-items: center; gap: 14px;">
            <div style="width: 44px; height: 44px; border-radius: var(--r-md); background: {{ $color }}22; border: 1px solid {{ $color }}55; display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 22px; color: {{ $color }};">{{ $icon }}</span>
            </div>
            <div>
                <div style="display: flex; gap: 8px; align-items: baseline;">
                    <span style="font: 700 14px/1 Inter; color: #fff;">{{ $titulo }}</span>
                    <span style="font: 800 13px/1 Inter; color: {{ $color }};">+{{ $pts }}</span>
                </div>
                <div style="font: 500 12px/1 Inter; color: var(--fg-muted); margin-top: 6px;">{{ $desc }}</div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- ===================== MODAL DE CONFIRMAÇÃO ===================== --}}
    @if($mostrarModal)
    <div class="modal-wrap" style="position: fixed; inset: 0; background: rgba(2,5,15,0.78); backdrop-filter: blur(12px); display: flex; align-items: center; justify-content: center; z-index: 50; padding: 40px;">
        <div class="modal-inner" style="width: 520px; background: var(--bg-elev-0); border: 1px solid var(--border-medium); border-radius: var(--r-2xl); box-shadow: 0 40px 90px rgba(0,0,0,0.65); overflow: hidden;">

            {{-- Cabeçalho amarelo de atenção --}}
            <div style="padding: 20px 24px; background: var(--grad-yellow); color: #1A0F00; display: flex; align-items: center; gap: 14px; position: relative;">
                <div style="position: absolute; inset: 0; opacity: .12; pointer-events: none; background-image: repeating-linear-gradient(45deg, rgba(0,0,0,1) 0 12px, transparent 12px 24px);"></div>
                <div style="width: 48px; height: 48px; border-radius: var(--r-md); background: rgba(0,0,0,0.12); border: 1.5px solid rgba(0,0,0,0.35); display: inline-flex; align-items: center; justify-content: center; z-index: 1; flex-shrink: 0;">
                    <span class="material-symbols-outlined ms-fill" style="font-size: 26px; color: #1A0F00;">priority_high</span>
                </div>
                <div style="z-index: 1;">
                    <div style="font: 800 11px/1 Inter; letter-spacing: .18em; text-transform: uppercase; color: #5A3A00;">Atenção · ação irreversível</div>
                    <div style="font: 900 20px/1.2 Inter; color: #1A0F00; margin-top: 6px; letter-spacing: -0.01em;">
                        Confirmar palpite Brasil {{ $golsBrasil }} × {{ $golsAdversario }} {{ $jogo->adversario }}?
                    </div>
                </div>
            </div>

            <div style="padding: 24px 28px 8px;">
                <p style="margin: 0; font: 500 14px/1.55 Inter; color: var(--fg-secondary);">
                    Após confirmar, <strong style="color: #fff;">seu palpite não pode ser alterado nem cancelado</strong>. O placar registrado vale pra contagem oficial do bolão e fica visível para todos após o apito final.
                </p>

                {{-- Resumo --}}
                <div style="margin-top: 20px; padding: 18px 20px; border-radius: var(--r-lg); background: rgba(0,0,0,0.25); border: 1px solid var(--border-medium);">
                    <div style="font: 600 10.5px/1 Inter; letter-spacing: .14em; text-transform: uppercase; color: var(--fg-muted); margin-bottom: 12px;">Resumo do palpite</div>
                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 16px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <img src="{{ asset('images/bandeira-brasil.png') }}" alt="Brasil"
                                 style="width: 36px; height: 26px; border-radius: 3px; object-fit: contain;" />
                            <span style="font: 700 14px/1 Inter; color: #fff;">Brasil</span>
                        </div>
                        <div style="font: 900 32px/1 Inter; letter-spacing: -0.04em; font-variant-numeric: tabular-nums; color: var(--br-yellow);">
                            {{ $golsBrasil }} <span style="color: var(--fg-faint); font-size: 22px;">×</span> {{ $golsAdversario }}
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span style="font: 700 14px/1 Inter; color: #fff;">{{ $jogo->adversario }}</span>
                            <img src="{{ $jogo->foto_url }}" alt="{{ $jogo->adversario }}"
                                 style="width: 36px; height: 26px; border-radius: 3px; object-fit: contain; background: var(--bg-elev-1); border: 1px solid var(--border-soft);" />
                        </div>
                    </div>
                </div>

                <p style="margin: 16px 0 0; font: 500 12.5px/1.45 Inter; color: var(--fg-secondary);">
                    <span style="display: inline-flex; align-items: center; gap: 6px;">
                        <span style="width: 16px; height: 16px; border-radius: 4px; background: var(--br-yellow); display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <span class="material-symbols-outlined" style="font-size: 12px; color: #1A0F00; font-variation-settings: 'wght' 800;">check</span>
                        </span>
                        Entendo que o palpite é definitivo e não pode ser alterado após confirmar.
                    </span>
                </p>
            </div>

            <div style="display: flex; gap: 12px; padding: 20px 28px 24px;">
                <button wire:click="fecharModal" class="btn-ghost" style="flex: 1; height: 48px;">
                    Voltar e revisar
                </button>
                <button wire:click="confirmar" wire:loading.attr="disabled" wire:target="confirmar" class="btn-primary" style="flex: 1.4; height: 48px;">
                    <span class="material-symbols-outlined" style="font-size: 18px;">lock</span>
                    <span wire:loading.remove wire:target="confirmar">Confirmar definitivamente</span>
                    <span wire:loading wire:target="confirmar" style="display:none">Registrando...</span>
                </button>
            </div>
        </div>
    </div>
    @endif

    @endif {{-- fim @else pode apostando --}}
</div>
