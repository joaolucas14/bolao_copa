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

    public function mount(): void
    {
        $this->premioValor     = Configuracao::obter('premio_valor', '0');
        $this->premioDescricao = Configuracao::obter('premio_descricao', 'A definir');
        $this->premioBonus     = Configuracao::obter('premio_bonus', '');
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

    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.admin.configuracoes');
    }
}
