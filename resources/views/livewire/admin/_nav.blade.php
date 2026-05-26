<div style="display: flex; gap: 4px; margin-bottom: 24px; border-bottom: 1px solid var(--border-soft); padding-bottom: 0;">
    @foreach([
        ['admin.jogos',         'sports_soccer',  'Jogos'],
        ['admin.usuarios',      'group',           'Usuários'],
        ['admin.configuracoes', 'settings',        'Configurações'],
    ] as [$rota, $icon, $label])
    @php $ativo = request()->routeIs($rota); @endphp
    <a href="{{ route($rota) }}" style="
        display: inline-flex; align-items: center; gap: 7px;
        padding: 0 16px; height: 38px;
        font: {{ $ativo ? '700' : '500' }} 13px/1 Inter; text-decoration: none;
        color: {{ $ativo ? '#fff' : 'var(--fg-secondary)' }};
        border-bottom: 2px solid {{ $ativo ? 'var(--br-yellow)' : 'transparent' }};
        margin-bottom: -1px;
        transition: color .15s;
    ">
        <span class="material-symbols-outlined" style="font-size: 16px; color: {{ $ativo ? 'var(--br-yellow)' : 'var(--fg-muted)' }};">{{ $icon }}</span>
        {{ $label }}
    </a>
    @endforeach
</div>
