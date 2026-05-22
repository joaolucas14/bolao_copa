<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class GerenciarUsuarios extends Component
{
    public bool $mostrarFormCriar = false;
    public string $nome = '';
    public string $email = '';
    public string $senha = '';
    public string $perfil = 'usuario';

    #[Layout('layouts.app')]
    public function render(): View
    {
        $usuarios = User::withCount('palpites')
            ->withSum('palpites', 'pontuacao')
            ->orderBy('nome')
            ->get();

        return view('livewire.admin.gerenciar-usuarios', compact('usuarios'));
    }

    public function toggleAtivo(int $id): void
    {
        $usuario = User::findOrFail($id);
        $usuario->update(['ativo' => ! $usuario->ativo]);
    }

    public function criar(): void
    {
        $this->validate([
            'nome'   => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email',
            'senha'  => 'required|min:6',
            'perfil' => 'required|in:admin,usuario',
        ]);

        User::create([
            'nome'     => $this->nome,
            'email'    => $this->email,
            'password' => bcrypt($this->senha),
            'perfil'   => $this->perfil,
            'ativo'    => true,
        ]);

        $this->reset('nome', 'email', 'senha', 'perfil', 'mostrarFormCriar');
    }
}
