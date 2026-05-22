<?php

namespace App\Services;

use App\Models\Jogo;
use App\Models\Palpite;
use App\Models\User;

class PalpiteService
{
    public function deveRevelar(Jogo $jogo): bool
    {
        // Condição 1: jogo já iniciou
        if ($jogo->data_hora && $jogo->data_hora->isPast()) {
            return true;
        }

        // Condição 2: todos os usuários ativos já apostaram
        $totalAtivos = User::where('ativo', true)->count();
        if ($totalAtivos === 0) {
            return false;
        }

        $totalPalpites = Palpite::where('jogo_id', $jogo->id)->count();

        return $totalPalpites >= $totalAtivos;
    }

    public function podeApostar(Jogo $jogo, User $usuario): array
    {
        if ($jogo->status === 'encerrado') {
            return [false, 'Jogo encerrado.'];
        }

        if ($jogo->status === 'agendado') {
            return [false, 'Palpites ainda não estão abertos para este jogo.'];
        }

        if (! $jogo->adversario) {
            return [false, 'Adversário ainda não definido.'];
        }

        if ($jogo->data_hora && $jogo->data_hora->isPast()) {
            return [false, 'O jogo já iniciou. Palpites encerrados.'];
        }

        $jaApostou = Palpite::where('jogo_id', $jogo->id)
            ->where('user_id', $usuario->id)
            ->exists();

        if ($jaApostou) {
            return [false, 'Você já registrou seu palpite para este jogo.'];
        }

        return [true, ''];
    }

    public function registrar(Jogo $jogo, User $usuario, int $golsBrasil, int $golsAdversario): Palpite
    {
        [$pode, $motivo] = $this->podeApostar($jogo, $usuario);

        if (! $pode) {
            throw new \RuntimeException($motivo);
        }

        return Palpite::create([
            'jogo_id'          => $jogo->id,
            'user_id'          => $usuario->id,
            'gols_brasil'      => $golsBrasil,
            'gols_adversario'  => $golsAdversario,
        ]);
    }
}
