<?php

namespace Tests\Unit;

use App\Models\Jogo;
use App\Models\Palpite;
use App\Services\PontuacaoService;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PontuacaoServiceTest extends TestCase
{
    private PontuacaoService $servico;

    protected function setUp(): void
    {
        parent::setUp();
        $this->servico = new PontuacaoService();
    }

    private function jogo(int $golsBrasil, int $golsAdv, bool $penaltis = false): Jogo
    {
        $jogo = new Jogo();
        $jogo->gols_brasil     = $golsBrasil;
        $jogo->gols_adversario = $golsAdv;
        $jogo->penaltis        = $penaltis;
        return $jogo;
    }

    private function palpite(int $golsBrasil, int $golsAdv): Palpite
    {
        $palpite = $this->createMock(Palpite::class);
        $palpite->gols_brasil     = $golsBrasil;
        $palpite->gols_adversario = $golsAdv;
        $palpite->expects($this->once())->method('update')->with($this->callback(function ($dados) use (&$resultado) {
            $resultado = $dados;
            return true;
        }));
        // Store result for assertion
        $palpite->__resultado = &$resultado;
        return $palpite;
    }

    #[DataProvider('casosProvider')]
    public function test_calcula_pontuacao(
        int $pBrasil, int $pAdv,
        int $jBrasil, int $jAdv,
        bool $penaltis,
        float $pontuacaoEsperada,
        bool $exato, bool $ganhador, bool $parcial
    ): void {
        $jogo = $this->jogo($jBrasil, $jAdv, $penaltis);

        $resultado = [];
        $palpite = $this->createMock(Palpite::class);
        $palpite->gols_brasil     = $pBrasil;
        $palpite->gols_adversario = $pAdv;
        $palpite->expects($this->once())->method('update')->with($this->callback(function ($dados) use (&$resultado) {
            $resultado = $dados;
            return true;
        }));

        $this->servico->calcular($palpite, $jogo);

        $this->assertSame($pontuacaoEsperada, $resultado['pontuacao']);
        $this->assertSame($exato,    $resultado['pts_exato']);
        $this->assertSame($ganhador, $resultado['pts_ganhador']);
        $this->assertSame($parcial,  $resultado['pts_parcial']);
    }

    public static function casosProvider(): array
    {
        return [
            // [p_br, p_adv, j_br, j_adv, penaltis, pts, exato, ganhador, parcial]
            'placar exato'                    => [2, 1, 2, 1, false, 3.0, true,  false, false],
            'ganhador certo sem exato'        => [3, 1, 2, 0, false, 1.5, false, true,  false],
            'empate acertado'                 => [1, 1, 0, 0, false, 1.5, false, true,  false],
            'gols brasil correto parcial'     => [2, 0, 2, 1, false, 0.5, false, false, true],
            'gols adversario correto parcial' => [1, 1, 2, 1, false, 0.5, false, false, true],
            'ganhador + parcial simultâneo'   => [3, 1, 2, 1, false, 2.0, false, true,  true],
            'sem pontos'                      => [0, 0, 2, 1, false, 0.0, false, false, false],
            'penaltis exato regulacao'        => [1, 1, 1, 1, true,  3.0, true,  false, false],
            'penaltis ganhador como empate'   => [0, 0, 1, 1, true,  3.0, true,  false, false],
            'penaltis sem exato previu vitoria'=> [2, 0, 1, 1, true,  0.0, false, false, false],
            'penaltis sem exato previu empate' => [1, 1, 2, 2, true,  1.5, false, true,  false],
            'penaltis sem parcial'            => [2, 1, 2, 2, true,  0.0, false, false, false],
            'derrota acertada'                => [0, 2, 1, 3, false, 1.5, false, true,  false],
        ];
    }
}
