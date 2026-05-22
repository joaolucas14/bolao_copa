<?php

namespace App\Livewire;

use App\Models\Jogo;
use App\Models\Palpite;
use App\Services\PalpiteService;
use Livewire\Attributes\On;
use Livewire\Component;

class FazPalpite extends Component
{
    public Jogo $jogo;

    public int $golsBrasil = 1;
    public int $golsAdversario = 0;
    public bool $mostrarModal = false;
    public bool $confirmado = false;

    public ?Palpite $meuPalpite = null;
    public bool $pode = false;
    public string $motivoBloqueio = '';

    public function mount(Jogo $jogo): void
    {
        $this->jogo = $jogo;
        $this->meuPalpite = Palpite::where('jogo_id', $jogo->id)
            ->where('user_id', auth()->id())
            ->first();

        if (! $this->meuPalpite) {
            [$this->pode, $this->motivoBloqueio] = app(PalpiteService::class)
                ->podeApostar($jogo, auth()->user());
        }
    }

    public function incrementar(string $campo): void
    {
        if ($campo === 'brasil') {
            $this->golsBrasil = min(20, $this->golsBrasil + 1);
        } else {
            $this->golsAdversario = min(20, $this->golsAdversario + 1);
        }
    }

    public function decrementar(string $campo): void
    {
        if ($campo === 'brasil') {
            $this->golsBrasil = max(0, $this->golsBrasil - 1);
        } else {
            $this->golsAdversario = max(0, $this->golsAdversario - 1);
        }
    }

    public function abrirModal(): void
    {
        $this->validate([
            'golsBrasil'      => 'required|integer|min:0|max:20',
            'golsAdversario'  => 'required|integer|min:0|max:20',
        ]);

        $this->mostrarModal = true;
    }

    public function fecharModal(): void
    {
        $this->mostrarModal = false;
    }

    public function confirmar(): void
    {
        $this->validate([
            'golsBrasil'      => 'required|integer|min:0|max:20',
            'golsAdversario'  => 'required|integer|min:0|max:20',
        ]);

        try {
            $this->meuPalpite = app(PalpiteService::class)->registrar(
                $this->jogo,
                auth()->user(),
                $this->golsBrasil,
                $this->golsAdversario,
            );

            $this->mostrarModal = false;
            $this->confirmado = true;
            $this->pode = false;
            $this->dispatch('toast', mensagem: 'Palpite registrado com sucesso!', tipo: 'sucesso');
        } catch (\RuntimeException $e) {
            $this->addError('geral', $e->getMessage());
            $this->mostrarModal = false;
        }
    }

    public function render()
    {
        return view('livewire.faz-palpite');
    }
}
