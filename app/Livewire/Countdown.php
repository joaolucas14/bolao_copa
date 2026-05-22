<?php

namespace App\Livewire;

use App\Models\Jogo;
use Livewire\Attributes\Poll;
use Livewire\Component;

class Countdown extends Component
{
    public ?int $jogoId = null;

    #[Poll(1000)]
    public function render()
    {
        $jogo = $this->jogoId ? Jogo::find($this->jogoId) : null;

        $aoVivo   = false;
        $passado  = false;
        $dias = $horas = $mins = $segs = 0;

        if ($jogo && $jogo->data_hora) {
            if ($jogo->data_hora->isPast()) {
                $passado = true;
                $aoVivo  = $jogo->estaAberto();
            } else {
                $diff  = now()->diff($jogo->data_hora);
                $dias  = $diff->days;
                $horas = $diff->h;
                $mins  = $diff->i;
                $segs  = $diff->s;
            }
        }

        return view('livewire.countdown', compact('aoVivo', 'passado', 'dias', 'horas', 'mins', 'segs'));
    }
}
