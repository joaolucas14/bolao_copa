<div style="padding: 28px 32px 48px; max-width: 1280px; margin: 0 auto;">
    <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 24px; gap: 20px; flex-wrap: wrap;">
        <div>
            <div style="font: 600 11px/1 Inter; letter-spacing: .16em; text-transform: uppercase; color: var(--br-yellow); margin-bottom: 10px; display: inline-flex; gap: 6px; align-items: center;">
                <span class="material-symbols-outlined" style="font-size: 13px;">shield_person</span>
                Painel administrativo
            </div>
            <h1 style="margin: 0; font: 800 28px/1.1 Inter; letter-spacing: -0.02em; color: #fff;">Gerenciar Usuários</h1>
        </div>
        <button wire:click="$toggle('mostrarFormCriar')" class="btn-primary" style="height: 44px;">
            <span class="material-symbols-outlined" style="font-size: 18px;">{{ $mostrarFormCriar ? 'close' : 'person_add' }}</span>
            {{ $mostrarFormCriar ? 'Cancelar' : 'Novo usuário' }}
        </button>
    </div>

    @include('livewire.admin._nav')

    {{-- ===================== FORM CRIAR USUÁRIO ===================== --}}
    @if($mostrarFormCriar)
    <div class="card" style="padding: 28px 32px; border-radius: var(--r-2xl); margin-bottom: 24px; border-color: rgba(31,214,107,0.25);">
        <div style="font: 700 16px/1 Inter; color: #fff; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
            <span class="material-symbols-outlined" style="font-size: 20px; color: #62F49B;">person_add</span>
            Criar novo usuário
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 16px; align-items: end;">
            <div>
                <label class="field-label">Nome</label>
                <div style="position: relative;">
                    <span class="material-symbols-outlined" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); font-size: 18px; color: var(--fg-muted);">person</span>
                    <input wire:model="nome" type="text" class="input-dark" placeholder="Nome completo" style="padding-left: 44px;">
                </div>
                @error('nome') <div style="margin-top: 5px; font: 500 11.5px/1 Inter; color: var(--danger);">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="field-label">E-mail</label>
                <div style="position: relative;">
                    <span class="material-symbols-outlined" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); font-size: 18px; color: var(--fg-muted);">mail</span>
                    <input wire:model="email" type="email" class="input-dark" placeholder="email@empresa.com" style="padding-left: 44px;">
                </div>
                @error('email') <div style="margin-top: 5px; font: 500 11.5px/1 Inter; color: var(--danger);">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="field-label">Senha</label>
                <div style="position: relative;">
                    <span class="material-symbols-outlined" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); font-size: 18px; color: var(--fg-muted);">lock</span>
                    <input wire:model="senha" type="password" class="input-dark" placeholder="Mínimo 6 caracteres" style="padding-left: 44px;">
                </div>
                @error('senha') <div style="margin-top: 5px; font: 500 11.5px/1 Inter; color: var(--danger);">{{ $message }}</div> @enderror
            </div>

            <div style="display: flex; align-items: end; gap: 12px;">
                <div style="flex: 1;">
                    <label class="field-label">Perfil</label>
                    <div style="position: relative;">
                        <span class="material-symbols-outlined" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); font-size: 18px; color: var(--fg-muted);">manage_accounts</span>
                        <select wire:model="perfil" class="input-dark" style="padding-left: 44px; cursor: pointer; appearance: none;">
                            <option value="usuario">Usuário</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <button wire:click="criar" class="btn-primary" style="height: 52px; flex-shrink: 0;">
                    <span class="material-symbols-outlined" style="font-size: 17px;">check</span>
                    Criar
                </button>
            </div>
        </div>
    </div>
    @endif

    {{-- ===================== TABELA USUÁRIOS ===================== --}}
    <div class="card" style="padding: 0; border-radius: var(--r-2xl); overflow: hidden;">
        <div class="tbl-row" style="grid-template-columns: 1fr 160px 90px 100px 140px; padding: 12px 24px; background: rgba(255,255,255,0.02); font: 600 10.5px/1 Inter; letter-spacing: .12em; text-transform: uppercase; color: var(--fg-muted); border-bottom: 1px solid var(--border-medium);">
            <div>Nome / E-mail</div><div>Perfil</div><div>Palpites</div><div>Pontos</div><div style="text-align: right;">Status</div>
        </div>
        @foreach($usuarios as $usuario)
        <div class="tbl-row" style="grid-template-columns: 1fr 160px 90px 100px 140px; padding: 14px 24px;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #1FD66B 0%, #002776 100%); display: inline-flex; align-items: center; justify-content: center; font: 700 12px/1 Inter; color: #fff; flex-shrink: 0;">
                    {{ strtoupper(substr($usuario->nome, 0, 2)) }}
                </div>
                <div>
                    <div style="font: 600 14px/1 Inter; color: #fff;">{{ $usuario->nome }}</div>
                    <div style="font: 500 12px/1 Inter; color: var(--fg-muted); margin-top: 4px;">{{ $usuario->email }}</div>
                </div>
            </div>
            <div>
                <span class="chip {{ $usuario->isAdmin() ? 'yellow' : '' }}">
                    @if($usuario->isAdmin())
                    <span class="material-symbols-outlined" style="font-size: 11px;">shield_person</span>
                    @endif
                    {{ $usuario->perfil }}
                </span>
            </div>
            <div style="font: 600 14px/1 Inter; color: #fff; font-variant-numeric: tabular-nums;">
                {{ $usuario->palpites_count ?? 0 }}
            </div>
            <div style="font: 700 14px/1 Inter; color: #fff; font-variant-numeric: tabular-nums;">
                {{ number_format($usuario->palpites_sum_pontuacao ?? 0, 1) }}
            </div>
            <div style="text-align: right;">
                <button wire:click="toggleAtivo({{ $usuario->id }})"
                        style="display: inline-flex; align-items: center; gap: 7px; padding: 5px 12px; border-radius: var(--r-pill); cursor: pointer; font: 600 11.5px/1 Inter; transition: all .2s var(--ease);
                        {{ $usuario->ativo
                            ? 'background: rgba(31,214,107,0.10); border: 1px solid rgba(31,214,107,0.35); color: #62F49B;'
                            : 'background: rgba(255,77,106,0.10); border: 1px solid rgba(255,77,106,0.35); color: #FF7A8E;' }}"
                        title="Clique para {{ $usuario->ativo ? 'desativar' : 'ativar' }}">
                    <span class="material-symbols-outlined" style="font-size: 14px;">{{ $usuario->ativo ? 'check_circle' : 'cancel' }}</span>
                    {{ $usuario->ativo ? 'Ativo' : 'Inativo' }}
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>
