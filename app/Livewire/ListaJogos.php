<?php

namespace App\Livewire;

use App\Models\Jogo;
use App\Models\Palpite;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ListaJogos extends Component
{
    #[Layout('layouts.app')]
    public function render(): View
    {
        $jogos = Jogo::orderBy('data_hora')->get();

        $jogosPalpitados = Palpite::where('user_id', auth()->id())
            ->whereIn('jogo_id', $jogos->pluck('id'))
            ->pluck('jogo_id')
            ->flip();

        return view('livewire.lista-jogos', compact('jogos', 'jogosPalpitados'));
    }
}
