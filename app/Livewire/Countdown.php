<?php

namespace App\Livewire;

use App\Models\Jogo;
use Livewire\Component;

class Countdown extends Component
{
    public ?int $jogoId = null;

    public function render()
    {
        $jogo      = $this->jogoId ? Jogo::find($this->jogoId) : null;
        $targetMs  = $jogo?->data_hora ? $jogo->data_hora->timestamp * 1000 : null;
        $aberto    = $jogo?->estaAberto() ?? false;

        return view('livewire.countdown', compact('targetMs', 'aberto'));
    }
}
