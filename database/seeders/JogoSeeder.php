<?php

namespace Database\Seeders;

use App\Models\Jogo;
use Illuminate\Database\Seeder;

class JogoSeeder extends Seeder
{
    public function run(): void
    {
        Jogo::create([
            'adversario' => 'Marrocos',
            'data_hora'  => '2026-06-15 16:00:00',
            'fase'       => 'grupos',
            'status'     => 'agendado',
        ]);

        Jogo::create([
            'adversario' => 'Haiti',
            'data_hora'  => '2026-06-20 13:00:00',
            'fase'       => 'grupos',
            'status'     => 'agendado',
        ]);

        Jogo::create([
            'adversario' => 'Escócia',
            'data_hora'  => '2026-06-24 16:00:00',
            'fase'       => 'grupos',
            'status'     => 'agendado',
        ]);

        Jogo::create(['fase' => 'dezesseis_avos', 'status' => 'agendado']);
        Jogo::create(['fase' => 'oitavas',        'status' => 'agendado']);
        Jogo::create(['fase' => 'quartas',        'status' => 'agendado']);
        Jogo::create(['fase' => 'semifinal',      'status' => 'agendado']);
        Jogo::create(['fase' => 'final',          'status' => 'agendado']);
    }
}
