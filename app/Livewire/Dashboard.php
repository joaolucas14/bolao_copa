<?php

namespace App\Livewire;

use App\Models\Configuracao;
use App\Models\Jogo;
use App\Models\Palpite;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Poll;
use Livewire\Component;

class Dashboard extends Component
{
    #[Layout('layouts.app')]
    #[Poll(60000)]
    public function render(): View
    {
        $proximoJogo = Jogo::proximoJogo()->first()
            ?? Jogo::where('status', 'agendado')->whereNotNull('adversario')->first();

        $ultimoJogo = Jogo::encerrado()->latest('updated_at')->first();

        $palpiteiroDaRodada = null;
        if ($ultimoJogo) {
            $palpiteiroDaRodada = Palpite::where('jogo_id', $ultimoJogo->id)
                ->whereNotNull('pontuacao')
                ->with('usuario')
                ->orderByDesc('pontuacao')
                ->first();
        }

        $ranking = User::where('ativo', true)
            ->withSum('palpites', 'pontuacao')
            ->withCount(['palpites as exatos' => fn ($q) => $q->where('pts_exato', true)])
            ->withCount(['palpites as ganhadores' => fn ($q) => $q->where('pts_ganhador', true)])
            ->withCount(['palpites as parciais' => fn ($q) => $q->where('pts_parcial', true)])
            ->orderByDesc('palpites_sum_pontuacao')
            ->get();

        $premioValor     = Configuracao::obter('premio_valor', '0');
        $premioDescricao = Configuracao::obter('premio_descricao', 'A definir');
        $premioBonus     = Configuracao::obter('premio_bonus', '');

        return view('livewire.dashboard', compact(
            'proximoJogo', 'ultimoJogo', 'palpiteiroDaRodada', 'ranking',
            'premioValor', 'premioDescricao', 'premioBonus',
        ));
    }
}
