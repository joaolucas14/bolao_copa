<?php

namespace App\Services;

use App\Models\Jogo;
use App\Models\Palpite;

class PontuacaoService
{
    public function calcular(Palpite $palpite, Jogo $jogo): void
    {
        $pontuacao = 0.0;
        $ptExato   = false;
        $ptGanhador = false;
        $ptParcial  = false;

        $golsB = $jogo->gols_brasil;
        $golsA = $jogo->gols_adversario;

        // Placar exato: compara gols da regulação (independente de penaltis)
        if ($palpite->gols_brasil === $golsB && $palpite->gols_adversario === $golsA) {
            $ptExato = true;
            $pontuacao += 3.0;
        }

        // Ganhador certo (não acumulável com exato)
        // Quando penaltis: trata resultado como empate (sinal 0)
        if (!$ptExato) {
            $signPalpite = $this->sinal($palpite->gols_brasil - $palpite->gols_adversario);
            $signJogo    = $jogo->penaltis ? 0 : $this->sinal($golsB - $golsA);

            if ($signPalpite === $signJogo) {
                $ptGanhador = true;
                $pontuacao += 1.5;
            }
        }

        // Gols parciais (não acumulável com exato, não se aplica quando penaltis)
        if (!$ptExato && !$jogo->penaltis) {
            $acertouBrasil = $palpite->gols_brasil === $golsB;
            $acertouAdv    = $palpite->gols_adversario === $golsA;

            // XOR: acertou exatamente um dos dois gols
            if ($acertouBrasil !== $acertouAdv) {
                $ptParcial = true;
                $pontuacao += 0.5;
            }
        }

        $palpite->update([
            'pts_exato'    => $ptExato,
            'pts_ganhador' => $ptGanhador,
            'pts_parcial'  => $ptParcial,
            'pontuacao'    => $pontuacao,
        ]);
    }

    private function sinal(int $valor): int
    {
        if ($valor > 0) return 1;
        if ($valor < 0) return -1;
        return 0;
    }
}
