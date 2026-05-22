<?php

namespace App\Livewire\Admin;

use App\Events\ResultadoRegistrado;
use App\Models\Jogo;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class GerenciarJogos extends Component
{
    use WithFileUploads;

    // Modal editar
    public bool $editando = false;
    public ?int $editJogoId = null;
    public string $editAdversario = '';
    public string $editDataHora = '';
    public string $editFase = 'grupos';
    public $editFoto = null;
    public ?string $editFotoAtual = null;

    // Modal resultado
    public bool $registrandoResultado = false;
    public ?int $resultJogoId = null;
    public int $resultGolsBrasil = 0;
    public int $resultGolsAdversario = 0;

    #[Layout('layouts.app')]
    public function render(): View
    {
        $jogos = Jogo::orderBy('data_hora')->get();

        return view('livewire.admin.gerenciar-jogos', compact('jogos'));
    }

    public function abrirEditar(int $id): void
    {
        $jogo = Jogo::findOrFail($id);
        $this->editJogoId    = $jogo->id;
        $this->editAdversario = $jogo->adversario ?? '';
        $this->editDataHora  = $jogo->data_hora ? $jogo->data_hora->format('Y-m-d\TH:i') : '';
        $this->editFase      = $jogo->fase;
        $this->editFotoAtual = $jogo->foto_adversario;
        $this->editFoto      = null;
        $this->editando      = true;
    }

    public function salvarEdicao(): void
    {
        $this->validate([
            'editAdversario' => 'required|string|max:60',
            'editDataHora'   => 'required|date',
            'editFase'       => 'required|in:grupos,dezesseis_avos,oitavas,quartas,semifinal,final',
            'editFoto'       => 'nullable|image|max:2048|mimes:jpg,jpeg,png,webp',
        ]);

        $dados = [
            'adversario' => $this->editAdversario,
            'data_hora'  => $this->editDataHora,
            'fase'       => $this->editFase,
        ];

        if ($this->editFoto) {
            $dados['foto_adversario'] = $this->editFoto->store('selecoes', 'public');
        }

        Jogo::findOrFail($this->editJogoId)->update($dados);

        $this->fecharEditar();
        $this->dispatch('toast', mensagem: 'Jogo atualizado!', tipo: 'sucesso');
    }

    public function fecharEditar(): void
    {
        $this->reset('editando', 'editJogoId', 'editAdversario', 'editDataHora', 'editFase', 'editFoto', 'editFotoAtual');
    }

    public function abrirPalpites(int $id): void
    {
        Jogo::findOrFail($id)->update(['status' => 'aberto']);
        $this->dispatch('toast', mensagem: 'Palpites abertos!', tipo: 'sucesso');
    }

    public function abrirResultado(int $id): void
    {
        $jogo = Jogo::findOrFail($id);
        $this->resultJogoId         = $jogo->id;
        $this->resultGolsBrasil     = $jogo->gols_brasil ?? 0;
        $this->resultGolsAdversario = $jogo->gols_adversario ?? 0;
        $this->registrandoResultado = true;
    }

    public function registrarResultado(): void
    {
        $this->validate([
            'resultGolsBrasil'     => 'required|integer|min:0|max:30',
            'resultGolsAdversario' => 'required|integer|min:0|max:30',
        ]);

        $jogo = Jogo::findOrFail($this->resultJogoId);

        $jogo->update([
            'gols_brasil'     => $this->resultGolsBrasil,
            'gols_adversario' => $this->resultGolsAdversario,
            'status'          => 'encerrado',
        ]);

        ResultadoRegistrado::dispatch($jogo);

        $this->fecharResultado();
        $this->dispatch('toast', mensagem: 'Resultado registrado! Pontuações calculadas.', tipo: 'sucesso');
    }

    public function fecharResultado(): void
    {
        $this->reset('registrandoResultado', 'resultJogoId', 'resultGolsBrasil', 'resultGolsAdversario');
    }

    public function decrementarBrasil(): void
    {
        $this->resultGolsBrasil = max(0, $this->resultGolsBrasil - 1);
    }

    public function incrementarBrasil(): void
    {
        $this->resultGolsBrasil++;
    }

    public function decrementarAdversario(): void
    {
        $this->resultGolsAdversario = max(0, $this->resultGolsAdversario - 1);
    }

    public function incrementarAdversario(): void
    {
        $this->resultGolsAdversario++;
    }
}
