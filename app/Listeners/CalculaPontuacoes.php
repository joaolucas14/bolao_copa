<?php

namespace App\Listeners;

use App\Events\ResultadoRegistrado;
use App\Services\PontuacaoService;

class CalculaPontuacoes
{
    public function __construct(private PontuacaoService $pontuacaoService) {}

    public function handle(ResultadoRegistrado $event): void
    {
        $jogo = $event->jogo->fresh();

        foreach ($jogo->palpites as $palpite) {
            $this->pontuacaoService->calcular($palpite, $jogo);
        }
    }
}
