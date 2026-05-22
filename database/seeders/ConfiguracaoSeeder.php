<?php

namespace Database\Seeders;

use App\Models\Configuracao;
use Illuminate\Database\Seeder;

class ConfiguracaoSeeder extends Seeder
{
    public function run(): void
    {
        Configuracao::definir('premio_descricao', 'A definir');
        Configuracao::definir('premio_valor', '0');
        Configuracao::definir('premio_bonus', '');
    }
}
