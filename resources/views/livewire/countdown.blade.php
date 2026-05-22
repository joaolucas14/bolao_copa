<div>
    @if($aoVivo)
    <div style="display: inline-flex; align-items: center; gap: 10px; padding: 8px 18px; border-radius: var(--r-pill); background: rgba(255,77,106,0.12); border: 1px solid rgba(255,77,106,0.40);">
        <span style="width: 8px; height: 8px; border-radius: 99px; background: #FF4D6A; box-shadow: 0 0 10px #FF4D6A; animation: pulse 1.5s ease-in-out infinite; display: inline-block;"></span>
        <span style="font: 700 13px/1 Inter; letter-spacing: .10em; text-transform: uppercase; color: #FF7A8E;">Ao vivo — palpites encerrados</span>
    </div>
    @elseif(!$passado)
    <div style="display: flex; gap: 8px; align-items: flex-end; flex-wrap: wrap;">
        @foreach([[$dias, 'DIAS'], [$horas, 'HORAS'], [$mins, 'MIN'], [$segs, 'SEG']] as [$val, $lbl])
        <div style="display: flex; flex-direction: column; align-items: center; gap: 4px;">
            <div style="min-width: 52px; padding: 10px 12px; border-radius: var(--r-md); background: rgba(0,0,0,0.38); border: 1px solid var(--border-medium); font: 800 26px/1 Inter; font-variant-numeric: tabular-nums; letter-spacing: -0.03em; color: #fff; text-align: center; box-shadow: 0 2px 0 rgba(255,255,255,0.06) inset;">{{ str_pad($val, 2, '0', STR_PAD_LEFT) }}</div>
            <span style="font: 600 10px/1 Inter; letter-spacing: .14em; text-transform: uppercase; color: var(--fg-muted);">{{ $lbl }}</span>
        </div>
        @if($lbl !== 'SEG')
        <span style="color: var(--fg-faint); font: 800 22px/1.4 Inter; margin-bottom: 16px;">:</span>
        @endif
        @endforeach
    </div>
    @endif

    <style>
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: .5; transform: scale(1.3); }
        }
    </style>
</div>
