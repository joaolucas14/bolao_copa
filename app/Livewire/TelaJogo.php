<?php

namespace App\Livewire;

use App\Models\Jogo;
use App\Models\Palpite;
use App\Services\PalpiteService;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Poll;
use Livewire\Component;

class TelaJogo extends Component
{
    public Jogo $jogo;
    public bool $revelado = false;

    public function mount(Jogo $jogo): void
    {
        $this->jogo = $jogo;
        $this->revelado = app(PalpiteService::class)->deveRevelar($jogo);
    }

    #[Layout('layouts.app')]
    #[Poll(30000)]
    public function verificarRevelacao(): void
    {
        $this->jogo->refresh();
        $this->revelado = app(PalpiteService::class)->deveRevelar($this->jogo);
    }

    public function render()
    {
        $palpites = $this->revelado
            ? Palpite::where('jogo_id', $this->jogo->id)
                ->with('usuario')
                ->get()
            : collect();

        $totalAtivos = \App\Models\User::where('ativo', true)->count();
        $totalPalpites = Palpite::where('jogo_id', $this->jogo->id)->count();

        return view('livewire.tela-jogo', compact('palpites', 'totalAtivos', 'totalPalpites'));
    }
}
