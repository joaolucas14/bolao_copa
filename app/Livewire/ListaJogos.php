<?php

namespace App\Livewire;

use App\Models\Jogo;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ListaJogos extends Component
{
    #[Layout('layouts.app')]
    public function render(): View
    {
        $jogos = Jogo::orderBy('data_hora')->get();

        return view('livewire.lista-jogos', compact('jogos'));
    }
}
