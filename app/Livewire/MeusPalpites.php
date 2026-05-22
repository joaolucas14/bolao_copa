<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class MeusPalpites extends Component
{
    #[Layout('layouts.app')]
    public function render(): View
    {
        /** @var User $usuario */
        $usuario = auth()->user();

        $palpites = $usuario->palpites()->with('jogo')->latest()->get();

        return view('livewire.meus-palpites', compact('palpites'));
    }
}
