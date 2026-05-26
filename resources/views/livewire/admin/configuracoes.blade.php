<div style="padding: 28px 32px 48px; max-width: 600px; margin: 0 auto;">
    <div style="margin-bottom: 28px;">
        <div style="font: 600 11px/1 Inter; letter-spacing: .16em; text-transform: uppercase; color: var(--br-yellow); margin-bottom: 10px;">
            <span class="material-symbols-outlined" style="font-size: 13px; vertical-align: -2px;">shield_person</span>
            Painel administrativo
        </div>
        <h1 style="margin: 0; font: 800 28px/1.1 Inter; letter-spacing: -0.02em; color: #fff;">Configurações</h1>
    </div>

    @include('livewire.admin._nav')

    <div class="card" style="padding: 28px; border-radius: var(--r-2xl); background: linear-gradient(180deg, #1A1206 0%, #0A0703 100%); border: 1px solid rgba(242,201,76,0.25);">
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 24px;">
            <div style="width: 36px; height: 36px; border-radius: var(--r-md); background: var(--grad-gold-chip); display: inline-flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(242,201,76,0.30);">
                <span class="material-symbols-outlined ms-fill" style="font-size: 20px; color: #5A3A00;">trophy</span>
            </div>
            <div>
                <div style="font: 700 16px/1 Inter; color: #fff;">Prêmio do bolão</div>
                <div style="font: 500 12px/1 Inter; color: var(--fg-muted); margin-top: 4px;">Disputado pelo 1º lugar</div>
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 16px;">
            <div>
                <label class="field-label">Valor em R$</label>
                <div style="position: relative;">
                    <span style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); font: 700 14px/1 Inter; color: var(--fg-muted);">R$</span>
                    <input
                        wire:model="premioValor"
                        type="text"
                        style="width: 100%; height: 52px; padding: 0 14px 0 44px; background: rgba(0,0,0,0.30); border: 1px solid rgba(242,201,76,0.30); border-radius: var(--r-md); color: #FFE08A; font: 800 20px/1 Inter; font-variant-numeric: tabular-nums; letter-spacing: -0.02em; outline: none; box-sizing: border-box;"
                    />
                </div>
            </div>

            <div>
                <label class="field-label">Descrição</label>
                <input wire:model="premioDescricao" type="text" class="input-dark" style="padding-left: 16px;" />
            </div>

            <div>
                <label class="field-label">Bônus extra (opcional)</label>
                <input wire:model="premioBonus" type="text" class="input-dark" style="padding-left: 16px;" placeholder="ex: 1 day off remunerado" />
            </div>

            <button wire:click="salvar" class="btn-gold" style="width: 100%; height: 48px; margin-top: 8px;">
                <span class="material-symbols-outlined" style="font-size: 18px;">save</span>
                Salvar configurações
            </button>
        </div>
    </div>

    {{-- ===== SITUAÇÃO DO BOLÃO ===== --}}
    <div class="card" style="margin-top: 20px; padding: 28px; border-radius: var(--r-2xl); border: 1px solid {{ $bolaoEncerrado ? 'rgba(255,77,106,0.35)' : 'rgba(31,214,107,0.25)' }}; background: {{ $bolaoEncerrado ? 'linear-gradient(180deg,#1A0608 0%,#0A0305 100%)' : 'linear-gradient(180deg,#071A0E 0%,#030A05 100%)' }};">
        <div style="display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 36px; height: 36px; border-radius: var(--r-md); background: {{ $bolaoEncerrado ? 'rgba(255,77,106,0.15)' : 'rgba(31,214,107,0.15)' }}; border: 1px solid {{ $bolaoEncerrado ? 'rgba(255,77,106,0.40)' : 'rgba(31,214,107,0.40)' }}; display: inline-flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined" style="font-size: 20px; color: {{ $bolaoEncerrado ? '#FF7A8E' : '#62F49B' }};">{{ $bolaoEncerrado ? 'lock' : 'lock_open' }}</span>
                </div>
                <div>
                    <div style="font: 700 15px/1 Inter; color: #fff;">Situação do Bolão</div>
                    <div style="display: flex; align-items: center; gap: 6px; margin-top: 6px;">
                        <span style="width: 7px; height: 7px; border-radius: 99px; background: {{ $bolaoEncerrado ? '#FF4D6A' : '#1FD66B' }}; box-shadow: 0 0 8px {{ $bolaoEncerrado ? '#FF4D6A' : '#1FD66B' }};"></span>
                        <span style="font: 600 12px/1 Inter; color: {{ $bolaoEncerrado ? '#FF7A8E' : '#62F49B' }};">{{ $bolaoEncerrado ? 'Encerrado — vencedor declarado' : 'Em andamento' }}</span>
                    </div>
                </div>
            </div>
            @if($bolaoEncerrado)
            <button wire:click="reabrirBolao" class="btn-ghost" style="height: 40px; font-size: 13px;">
                <span class="material-symbols-outlined" style="font-size: 16px;">lock_open</span>
                Reabrir Bolão
            </button>
            @else
            <button wire:click="$set('mostrarModalEncerrar', true)" style="height: 40px; padding: 0 20px; border-radius: var(--r-pill); background: rgba(255,77,106,0.12); border: 1px solid rgba(255,77,106,0.40); color: #FF7A8E; font: 700 13px/1 Inter; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
                <span class="material-symbols-outlined" style="font-size: 16px;">lock</span>
                Encerrar Bolão
            </button>
            @endif
        </div>
    </div>

    {{-- Modal de confirmação --}}
    @if($mostrarModalEncerrar)
    <div style="position: fixed; inset: 0; background: rgba(2,5,15,0.80); backdrop-filter: blur(12px); display: flex; align-items: center; justify-content: center; z-index: 50; padding: 40px;">
        <div style="width: 480px; background: var(--bg-elev-0); border: 1px solid rgba(255,77,106,0.35); border-radius: var(--r-2xl); box-shadow: 0 40px 90px rgba(0,0,0,0.65); overflow: hidden;">
            <div style="padding: 20px 24px; background: linear-gradient(135deg, rgba(255,77,106,0.20) 0%, rgba(255,77,106,0.05) 100%); border-bottom: 1px solid rgba(255,77,106,0.20); display: flex; align-items: center; gap: 14px;">
                <div style="width: 44px; height: 44px; border-radius: var(--r-md); background: rgba(255,77,106,0.15); border: 1px solid rgba(255,77,106,0.40); display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <span class="material-symbols-outlined ms-fill" style="font-size: 24px; color: #FF7A8E;">lock</span>
                </div>
                <div>
                    <div style="font: 800 11px/1 Inter; letter-spacing: .16em; text-transform: uppercase; color: #FF7A8E;">Ação irreversível</div>
                    <div style="font: 800 18px/1.2 Inter; color: #fff; margin-top: 5px;">Encerrar o Bolão Innovate?</div>
                </div>
            </div>
            <div style="padding: 24px 28px;">
                <p style="margin: 0; font: 500 14px/1.6 Inter; color: var(--fg-secondary);">
                    Ao encerrar o bolão, o <strong style="color: #fff;">vencedor será declarado</strong> com base no ranking atual e o resultado ficará visível para todos os participantes.
                </p>
                <p style="margin: 12px 0 0; font: 500 13px/1.5 Inter; color: var(--fg-muted);">
                    Você poderá reabrir o bolão se precisar corrigir algum resultado.
                </p>
            </div>
            <div style="display: flex; gap: 12px; padding: 0 28px 24px;">
                <button wire:click="$set('mostrarModalEncerrar', false)" class="btn-ghost" style="flex: 1; height: 46px;">
                    Cancelar
                </button>
                <button wire:click="encerrarBolao" style="flex: 1.4; height: 46px; border-radius: var(--r-pill); background: linear-gradient(135deg, #FF4D6A 0%, #C0002A 100%); border: none; color: #fff; font: 700 14px/1 Inter; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 8px;">
                    <span class="material-symbols-outlined" style="font-size: 18px;">lock</span>
                    Sim, encerrar bolão
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
