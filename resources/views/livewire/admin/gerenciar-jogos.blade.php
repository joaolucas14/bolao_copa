<div style="padding: 28px 32px 48px; max-width: 1280px; margin: 0 auto;">
    <div style="margin-bottom: 24px;">
        <div style="font: 600 11px/1 Inter; letter-spacing: .16em; text-transform: uppercase; color: var(--br-yellow); margin-bottom: 10px; display: inline-flex; gap: 8px; align-items: center;">
            <span class="material-symbols-outlined" style="font-size: 13px;">shield_person</span>
            Painel administrativo
        </div>
        <h1 style="margin: 0; font: 800 28px/1.1 Inter; letter-spacing: -0.02em; color: #fff;">Gerenciar Jogos</h1>
    </div>

    @include('livewire.admin._nav')

    <div class="card card-scroll" style="padding: 0; border-radius: var(--r-2xl); overflow: hidden;">
        <div class="tbl-row" style="grid-template-columns: 56px 1fr 160px 130px 110px 190px; padding: 12px 24px; background: rgba(255,255,255,0.02); font: 600 10.5px/1 Inter; letter-spacing: .12em; text-transform: uppercase; color: var(--fg-muted); border-bottom: 1px solid var(--border-medium);">
            <div>#</div><div>Confronto</div><div>Data/Hora</div><div>Fase</div><div>Status</div><div style="text-align: right;">Ações</div>
        </div>
        @foreach($jogos as $jogo)
        @php
            $statusMap = [
                'agendado'  => ['color' => 'var(--fg-muted)',  'bg' => 'rgba(255,255,255,0.04)', 'border' => 'var(--border-medium)',        'label' => 'AGENDADO'],
                'aberto'    => ['color' => '#FEDF00',          'bg' => 'rgba(254,223,0,0.10)',   'border' => 'rgba(254,223,0,0.35)',        'label' => 'EM ABERTO'],
                'encerrado' => ['color' => '#62F49B',          'bg' => 'rgba(31,214,107,0.10)',  'border' => 'rgba(31,214,107,0.35)',       'label' => 'ENCERRADO'],
            ][$jogo->status];
        @endphp
        <div class="tbl-row" style="grid-template-columns: 56px 1fr 160px 130px 110px 190px; padding: 14px 24px;">
            <div style="font: 700 13px/1 Inter; color: var(--fg-muted);">{{ $jogo->id }}</div>
            <div>
                <div style="font: 600 14px/1 Inter; color: #fff;">Brasil × {{ $jogo->adversario ?? '???' }}</div>
                @if($jogo->estaEncerrado() && $jogo->gols_brasil !== null)
                <div style="font: 700 12px/1 Inter; color: var(--br-yellow); margin-top: 5px; font-variant-numeric: tabular-nums;">
                    Resultado: {{ $jogo->gols_brasil }} × {{ $jogo->gols_adversario }}
                    @if($jogo->penaltis) <span style="font-weight: 500; color: var(--fg-muted);">(penaltis)</span>@endif
                </div>
                @endif
            </div>
            <div style="font: 500 13px/1.3 Inter; color: var(--fg-secondary);">
                {{ $jogo->data_hora ? $jogo->data_hora->format('d/m/Y H:i') : '—' }}
            </div>
            <div style="font: 500 13px/1 Inter; color: var(--fg-secondary);">{{ \App\Models\Jogo::FASES[$jogo->fase] ?? ucfirst($jogo->fase) }}</div>
            <div>
                <span style="display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; border-radius: var(--r-pill); background: {{ $statusMap['bg'] }}; border: 1px solid {{ $statusMap['border'] }}; font: 700 10px/1 Inter; letter-spacing: .12em; color: {{ $statusMap['color'] }};">
                    {{ $statusMap['label'] }}
                </span>
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 6px;">
                {{-- Abrir palpites --}}
                @if($jogo->status === 'agendado')
                <button wire:click="abrirPalpites({{ $jogo->id }})"
                        style="height: 32px; padding: 0 12px; border-radius: var(--r-md); background: rgba(254,223,0,0.10); border: 1px solid rgba(254,223,0,0.35); color: #FEDF00; font: 600 11px/1 Inter; letter-spacing: .06em; cursor: pointer; display: inline-flex; align-items: center; gap: 5px;"
                        title="Abrir palpites">
                    <span class="material-symbols-outlined" style="font-size: 14px;">lock_open</span>
                    Abrir
                </button>
                @endif

                {{-- Registrar resultado --}}
                @if(!$jogo->estaEncerrado())
                <button wire:click="abrirResultado({{ $jogo->id }})"
                        style="width: 32px; height: 32px; border-radius: var(--r-md); background: rgba(31,214,107,0.10); border: 1px solid rgba(31,214,107,0.30); color: #62F49B; display: inline-flex; align-items: center; justify-content: center; cursor: pointer;"
                        title="Registrar resultado">
                    <span class="material-symbols-outlined" style="font-size: 16px;">scoreboard</span>
                </button>
                @endif

                {{-- Editar --}}
                @if(!$jogo->estaEncerrado())
                <button wire:click="abrirEditar({{ $jogo->id }})"
                        style="width: 32px; height: 32px; border-radius: var(--r-md); background: rgba(255,255,255,0.04); border: 1px solid var(--border-medium); color: var(--fg-secondary); display: inline-flex; align-items: center; justify-content: center; cursor: pointer;"
                        title="Editar">
                    <span class="material-symbols-outlined" style="font-size: 16px;">edit</span>
                </button>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    {{-- ===================== MODAL EDITAR JOGO ===================== --}}
    @if($editando)
    <div class="modal-wrap" style="position: fixed; inset: 0; background: rgba(2,5,15,0.78); backdrop-filter: blur(12px); display: flex; align-items: center; justify-content: center; z-index: 50; padding: 40px;">
        <div class="modal-inner" style="width: 480px; background: var(--bg-elev-0); border: 1px solid var(--border-medium); border-radius: var(--r-2xl); box-shadow: 0 40px 90px rgba(0,0,0,0.65); overflow: hidden;">
            <div style="padding: 20px 24px; border-bottom: 1px solid var(--border-soft); display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <div style="font: 600 11px/1 Inter; letter-spacing: .14em; text-transform: uppercase; color: var(--br-yellow);">Administração</div>
                    <div style="font: 700 18px/1 Inter; color: #fff; margin-top: 6px;">Editar jogo</div>
                </div>
                <button wire:click="fecharEditar" style="width: 32px; height: 32px; border-radius: var(--r-md); background: rgba(255,255,255,0.04); border: 1px solid var(--border-medium); color: var(--fg-muted); cursor: pointer; display: inline-flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined" style="font-size: 18px;">close</span>
                </button>
            </div>

            <div style="padding: 24px;">
                <div style="display: flex; flex-direction: column; gap: 18px;">

                    <div>
                        <label class="field-label">Adversário</label>
                        <div style="position: relative;">
                            <span class="material-symbols-outlined" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); font-size: 18px; color: var(--fg-muted);">flag</span>
                            <input wire:model="editAdversario" type="text" class="input-dark" placeholder="Ex: Argentina" style="padding-left: 44px;">
                        </div>
                        @error('editAdversario') <div style="margin-top: 6px; font: 500 12px/1 Inter; color: var(--danger);">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="field-label">Data e Hora</label>
                        <div style="position: relative;">
                            <span class="material-symbols-outlined" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); font-size: 18px; color: var(--fg-muted);">calendar_month</span>
                            <input wire:model="editDataHora" type="datetime-local" class="input-dark" style="padding-left: 44px;">
                        </div>
                        @error('editDataHora') <div style="margin-top: 6px; font: 500 12px/1 Inter; color: var(--danger);">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="field-label">Fase</label>
                        <div style="position: relative;">
                            <span class="material-symbols-outlined" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); font-size: 18px; color: var(--fg-muted);">emoji_events</span>
                            <select wire:model="editFase" class="input-dark" style="padding-left: 44px; cursor: pointer; appearance: none;">
                                @foreach(\App\Models\Jogo::FASES as $valor => $label)
                                <option value="{{ $valor }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="field-label">Foto da seleção adversária</label>
                        <input wire:model="editFoto" type="file" accept="image/*"
                               style="display: block; width: 100%; padding: 10px 14px; background: rgba(255,255,255,0.04); border: 1px solid var(--border-medium); border-radius: var(--r-md); color: var(--fg-secondary); font: 500 13px/1 Inter; cursor: pointer; box-sizing: border-box;">
                        @if($editFotoAtual || $editFoto)
                        <div style="margin-top: 10px; display: flex; align-items: center; gap: 10px;">
                            @if($editFoto)
                            <img src="{{ $editFoto->temporaryUrl() }}" alt="Preview"
                                 style="width: 56px; height: 40px; border-radius: 6px; object-fit: contain; background: var(--bg-elev-1); border: 2px solid var(--br-yellow);" />
                            <span style="font: 500 12px/1 Inter; color: var(--br-yellow);">Nova foto</span>
                            @elseif($editFotoAtual)
                            <img src="{{ Storage::url($editFotoAtual) }}" alt="Foto atual"
                                 style="width: 56px; height: 40px; border-radius: 6px; object-fit: contain; background: var(--bg-elev-1); border: 1px solid var(--border-medium);" />
                            <span style="font: 500 12px/1 Inter; color: var(--fg-muted);">Foto atual</span>
                            @endif
                        </div>
                        @endif
                        @error('editFoto') <div style="margin-top: 6px; font: 500 12px/1 Inter; color: var(--danger);">{{ $message }}</div> @enderror
                    </div>

                </div>
            </div>

            <div style="display: flex; gap: 12px; padding: 0 24px 24px;">
                <button wire:click="fecharEditar" class="btn-ghost" style="flex: 1;">Cancelar</button>
                <button wire:click="salvarEdicao" class="btn-primary" style="flex: 1.5;">
                    <span class="material-symbols-outlined" style="font-size: 17px;">save</span>
                    Salvar
                </button>
            </div>
        </div>
    </div>
    @endif

    {{-- ===================== MODAL REGISTRAR RESULTADO ===================== --}}
    @if($registrandoResultado)
    <div class="modal-wrap" style="position: fixed; inset: 0; background: rgba(2,5,15,0.78); backdrop-filter: blur(12px); display: flex; align-items: center; justify-content: center; z-index: 50; padding: 40px;">
        <div class="modal-inner" style="width: 440px; background: var(--bg-elev-0); border: 1px solid var(--border-medium); border-radius: var(--r-2xl); box-shadow: 0 40px 90px rgba(0,0,0,0.65); overflow: hidden;">
            <div style="padding: 20px 24px; border-bottom: 1px solid var(--border-soft); display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <div style="font: 600 11px/1 Inter; letter-spacing: .14em; text-transform: uppercase; color: #62F49B;">Resultado oficial</div>
                    <div style="font: 700 18px/1 Inter; color: #fff; margin-top: 6px;">Registrar placar</div>
                </div>
                <button wire:click="fecharResultado" style="width: 32px; height: 32px; border-radius: var(--r-md); background: rgba(255,255,255,0.04); border: 1px solid var(--border-medium); color: var(--fg-muted); cursor: pointer; display: inline-flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined" style="font-size: 18px;">close</span>
                </button>
            </div>

            <div style="padding: 28px 32px;">
                <div style="display: grid; grid-template-columns: 1fr auto 1fr; gap: 16px; align-items: center; margin-bottom: 20px;">
                    {{-- Brasil --}}
                    <div style="text-align: center;">
                        <div style="font: 700 13px/1 Inter; letter-spacing: .06em; color: var(--fg-muted); text-transform: uppercase; margin-bottom: 12px;">Brasil</div>
                        <div style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                            <button wire:click="decrementarBrasil"
                                    style="width: 36px; height: 36px; border-radius: var(--r-pill); background: rgba(255,255,255,0.04); border: 1px solid var(--border-medium); color: #fff; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;">
                                <span class="material-symbols-outlined" style="font-size: 20px;">remove</span>
                            </button>
                            <span style="font: 900 52px/1 Inter; font-variant-numeric: tabular-nums; letter-spacing: -0.04em; color: #1FD66B; min-width: 52px; text-align: center;">{{ $resultGolsBrasil }}</span>
                            <button wire:click="incrementarBrasil"
                                    style="width: 36px; height: 36px; border-radius: var(--r-pill); background: rgba(31,214,107,0.15); border: 1px solid rgba(31,214,107,0.40); color: #1FD66B; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;">
                                <span class="material-symbols-outlined" style="font-size: 20px;">add</span>
                            </button>
                        </div>
                    </div>

                    <span style="font: 900 32px/1 Inter; color: var(--fg-faint); letter-spacing: -0.06em;">×</span>

                    {{-- Adversário --}}
                    <div style="text-align: center;">
                        <div style="font: 700 13px/1 Inter; letter-spacing: .06em; color: var(--fg-muted); text-transform: uppercase; margin-bottom: 12px;">Adv.</div>
                        <div style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                            <button wire:click="decrementarAdversario"
                                    style="width: 36px; height: 36px; border-radius: var(--r-pill); background: rgba(255,255,255,0.04); border: 1px solid var(--border-medium); color: #fff; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;">
                                <span class="material-symbols-outlined" style="font-size: 20px;">remove</span>
                            </button>
                            <span style="font: 900 52px/1 Inter; font-variant-numeric: tabular-nums; letter-spacing: -0.04em; color: #FF7A8E; min-width: 52px; text-align: center;">{{ $resultGolsAdversario }}</span>
                            <button wire:click="incrementarAdversario"
                                    style="width: 36px; height: 36px; border-radius: var(--r-pill); background: rgba(255,77,106,0.12); border: 1px solid rgba(255,77,106,0.35); color: #FF7A8E; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;">
                                <span class="material-symbols-outlined" style="font-size: 20px;">add</span>
                            </button>
                        </div>
                    </div>
                </div>

                @error('resultGolsBrasil') <div style="margin-top: 8px; font: 500 12px/1 Inter; color: var(--danger);">{{ $message }}</div> @enderror
            </div>

            <div style="display: flex; gap: 12px; padding: 0 24px 24px;">
                <button wire:click="fecharResultado" class="btn-ghost" style="flex: 1;">Cancelar</button>
                <button wire:click="registrarResultado" class="btn-primary" style="flex: 1.5;">
                    <span class="material-symbols-outlined" style="font-size: 17px;">check_circle</span>
                    Confirmar resultado
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
