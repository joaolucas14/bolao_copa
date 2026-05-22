<div style="padding: 28px 32px 48px; max-width: 600px; margin: 0 auto;">
    <div style="margin-bottom: 28px;">
        <div style="font: 600 11px/1 Inter; letter-spacing: .16em; text-transform: uppercase; color: var(--br-yellow); margin-bottom: 10px;">
            <span class="material-symbols-outlined" style="font-size: 13px; vertical-align: -2px;">shield_person</span>
            Painel administrativo
        </div>
        <h1 style="margin: 0; font: 800 28px/1.1 Inter; letter-spacing: -0.02em; color: #fff;">Configurações</h1>
    </div>

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
</div>
