<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nome' => 'Admin',
            'email' => 'admin@innovate.com',
            'password' => Hash::make('senha123'),
            'perfil' => 'admin',
            'ativo' => true,
        ]);

        User::create([
            'nome' => 'João Teste',
            'email' => 'joao@innovate.com',
            'password' => Hash::make('senha123'),
            'perfil' => 'usuario',
            'ativo' => true,
        ]);

        User::create([
            'nome' => 'Maria Teste',
            'email' => 'maria@innovate.com',
            'password' => Hash::make('senha123'),
            'perfil' => 'usuario',
            'ativo' => true,
        ]);
    }
}
