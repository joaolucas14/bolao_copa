<div wire:ignore
     x-data="bolaoCountdown({{ $targetMs ?? 'null' }}, {{ $aberto ? 'true' : 'false' }})"
     x-init="init()">

    <template x-if="aoVivo">
        <div style="display: inline-flex; align-items: center; gap: 10px; padding: 8px 18px; border-radius: var(--r-pill); background: rgba(255,77,106,0.12); border: 1px solid rgba(255,77,106,0.40);">
            <span style="width: 8px; height: 8px; border-radius: 99px; background: #FF4D6A; box-shadow: 0 0 10px #FF4D6A; animation: pulse 1.5s ease-in-out infinite; display: inline-block;"></span>
            <span style="font: 700 13px/1 Inter; letter-spacing: .10em; text-transform: uppercase; color: #FF7A8E;">Ao vivo — palpites encerrados</span>
        </div>
    </template>

    <template x-if="!aoVivo && !passado">
        <div style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
            <template x-if="bloqueado">
                <div style="display: inline-flex; align-items: center; gap: 8px; padding: 6px 14px; border-radius: var(--r-pill); background: rgba(255,165,0,0.12); border: 1px solid rgba(255,165,0,0.40);">
                    <span class="material-symbols-outlined" style="font-size: 14px; color: #FFA500;">lock</span>
                    <span style="font: 700 12px/1 Inter; letter-spacing: .10em; text-transform: uppercase; color: #FFA500;">Palpites encerrados</span>
                </div>
            </template>

            <div style="display: flex; gap: 8px; align-items: flex-end; flex-wrap: wrap;">
                <template x-if="dias > 0">
                    <div style="display: flex; flex-direction: column; align-items: center; gap: 4px;">
                        <div style="min-width: 52px; padding: 10px 12px; border-radius: var(--r-md); background: rgba(0,0,0,0.38); border: 1px solid var(--border-medium); font: 800 26px/1 Inter; font-variant-numeric: tabular-nums; letter-spacing: -0.03em; color: #fff; text-align: center; box-shadow: 0 2px 0 rgba(255,255,255,0.06) inset;" x-text="String(dias).padStart(2,'0')"></div>
                        <span style="font: 600 10px/1 Inter; letter-spacing: .14em; text-transform: uppercase; color: var(--fg-muted);">DIAS</span>
                    </div>
                </template>
                <template x-if="dias > 0">
                    <span style="color: var(--fg-faint); font: 800 22px/1.4 Inter; margin-bottom: 16px;">:</span>
                </template>

                <div style="display: flex; flex-direction: column; align-items: center; gap: 4px;">
                    <div style="min-width: 52px; padding: 10px 12px; border-radius: var(--r-md); background: rgba(0,0,0,0.38); border: 1px solid var(--border-medium); font: 800 26px/1 Inter; font-variant-numeric: tabular-nums; letter-spacing: -0.03em; color: #fff; text-align: center; box-shadow: 0 2px 0 rgba(255,255,255,0.06) inset;" x-text="String(horas).padStart(2,'0')"></div>
                    <span style="font: 600 10px/1 Inter; letter-spacing: .14em; text-transform: uppercase; color: var(--fg-muted);">HORAS</span>
                </div>
                <span style="color: var(--fg-faint); font: 800 22px/1.4 Inter; margin-bottom: 16px;">:</span>

                <div style="display: flex; flex-direction: column; align-items: center; gap: 4px;">
                    <div style="min-width: 52px; padding: 10px 12px; border-radius: var(--r-md); background: rgba(0,0,0,0.38); border: 1px solid var(--border-medium); font: 800 26px/1 Inter; font-variant-numeric: tabular-nums; letter-spacing: -0.03em; color: #fff; text-align: center; box-shadow: 0 2px 0 rgba(255,255,255,0.06) inset;" x-text="String(mins).padStart(2,'0')"></div>
                    <span style="font: 600 10px/1 Inter; letter-spacing: .14em; text-transform: uppercase; color: var(--fg-muted);">MIN</span>
                </div>
                <span style="color: var(--fg-faint); font: 800 22px/1.4 Inter; margin-bottom: 16px;">:</span>

                <div style="display: flex; flex-direction: column; align-items: center; gap: 4px;">
                    <div style="min-width: 52px; padding: 10px 12px; border-radius: var(--r-md); background: rgba(0,0,0,0.38); border: 1px solid var(--border-medium); font: 800 26px/1 Inter; font-variant-numeric: tabular-nums; letter-spacing: -0.03em; color: #fff; text-align: center; box-shadow: 0 2px 0 rgba(255,255,255,0.06) inset;" x-text="String(segs).padStart(2,'0')"></div>
                    <span style="font: 600 10px/1 Inter; letter-spacing: .14em; text-transform: uppercase; color: var(--fg-muted);">SEG</span>
                </div>
            </div>
        </div>
    </template>

    <style>
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: .5; transform: scale(1.3); }
        }
    </style>
</div>

<script>
function bolaoDeadline(jogoMs) {
    return {
        texto: '',

        init() {
            this.tick();
            const id = setInterval(() => this.tick(), 1000);
            this.$cleanup(() => clearInterval(id));
        },

        tick() {
            const agora      = Date.now();
            const deadlineMs = jogoMs - 3_600_000;
            const diffJogo   = jogoMs - agora;
            const diffDeadline = deadlineMs - agora;

            if (diffJogo <= 0) {
                this.texto = 'Palpites encerrados';
                return;
            }
            if (diffDeadline <= 0) {
                this.texto = 'Palpites encerrados — jogo em ' + this._human(diffJogo);
                return;
            }
            this.texto = 'Palpites se encerram em ' + this._human(diffDeadline);
        },

        _human(ms) {
            const s = Math.floor(ms / 1000);
            if (s < 45)  return 'alguns segundos';
            if (s < 90)  return '1 minuto';
            const m = Math.floor(s / 60);
            if (m < 45)  return m + ' minutos';
            if (m < 90)  return '1 hora';
            const h = Math.floor(m / 60);
            if (h < 22)  return h + ' horas';
            if (h < 36)  return '1 dia';
            const d = Math.floor(h / 24);
            return d + ' dias';
        }
    };
}

function bolaoCountdown(targetMs, aberto) {
    return {
        dias: 0, horas: 0, mins: 0, segs: 0,
        aoVivo: false, passado: false, bloqueado: false,

        init() {
            if (!targetMs) return;
            this.tick();
            const id = setInterval(() => this.tick(), 1000);
            this.$cleanup(() => clearInterval(id));
        },

        tick() {
            const diff = targetMs - Date.now();

            if (diff <= 0) {
                this.passado = true;
                this.aoVivo  = aberto;
                this.dias = this.horas = this.mins = this.segs = 0;
                return;
            }

            const total     = Math.floor(diff / 1000);
            this.passado    = false;
            this.aoVivo     = false;
            this.bloqueado  = diff <= 3_600_000;
            this.dias       = Math.floor(total / 86400);
            this.horas      = Math.floor((total % 86400) / 3600);
            this.mins       = Math.floor((total % 3600) / 60);
            this.segs       = total % 60;
        }
    };
}
</script>
