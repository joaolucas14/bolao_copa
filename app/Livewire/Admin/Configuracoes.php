<?php

namespace App\Livewire\Admin;

use App\Models\Configuracao;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Configuracoes extends Component
{
    public string $premioValor = '';
    public string $premioDescricao = '';
    public string $premioBonus = '';
    public bool $bolaoEncerrado = false;
    public bool $mostrarModalEncerrar = false;

    public function mount(): void
    {
        $this->premioValor     = Configuracao::obter('premio_valor', '0');
        $this->premioDescricao = Configuracao::obter('premio_descricao', 'A definir');
        $this->premioBonus     = Configuracao::obter('premio_bonus', '');
        $this->bolaoEncerrado  = Configuracao::obter('bolao_encerrado', '0') === '1';
    }

    public function salvar(): void
    {
        $this->validate([
            'premioDescricao' => 'required|string|max:200',
            'premioValor'     => 'required|string|max:100',
            'premioBonus'     => 'nullable|string|max:200',
        ]);

        Configuracao::definir('premio_valor', $this->premioValor);
        Configuracao::definir('premio_descricao', $this->premioDescricao);
        Configuracao::definir('premio_bonus', $this->premioBonus);

        $this->dispatch('toast', mensagem: 'Configurações salvas com sucesso!', tipo: 'sucesso');
    }

    public function encerrarBolao(): void
    {
        Configuracao::definir('bolao_encerrado', '1');
        $this->bolaoEncerrado = true;
        $this->mostrarModalEncerrar = false;
        $this->dispatch('toast', mensagem: 'Bolão encerrado! Vencedor declarado no painel.', tipo: 'sucesso');
    }

    public function reabrirBolao(): void
    {
        Configuracao::definir('bolao_encerrado', '0');
        $this->bolaoEncerrado = false;
        $this->dispatch('toast', mensagem: 'Bolão reaberto.', tipo: 'sucesso');
    }

    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.admin.configuracoes');
    }
}
