<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Passo 1: expande o enum para aceitar valores antigos e novos simultaneamente
        DB::statement("ALTER TABLE jogos MODIFY COLUMN fase ENUM(
            'grupo', 'grupos', 'dezesseis_avos', 'oitavas', 'quartas',
            'semi', 'semifinal', 'terceiro', 'final'
        ) NOT NULL DEFAULT 'grupo'");

        // Passo 2: migra os dados para os novos valores
        DB::table('jogos')->where('fase', 'grupo')->update(['fase' => 'grupos']);
        DB::table('jogos')->where('fase', 'semi')->update(['fase' => 'semifinal']);
        DB::table('jogos')->where('fase', 'terceiro')->update(['fase' => 'final']);

        // Passo 3: restringe ao enum final
        DB::statement("ALTER TABLE jogos MODIFY COLUMN fase ENUM(
            'grupos', 'dezesseis_avos', 'oitavas', 'quartas', 'semifinal', 'final'
        ) NOT NULL DEFAULT 'grupos'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE jogos MODIFY COLUMN fase ENUM(
            'grupo', 'grupos', 'oitavas', 'quartas', 'semi', 'semifinal', 'terceiro', 'final'
        ) NOT NULL DEFAULT 'grupos'");

        DB::table('jogos')->where('fase', 'grupos')->update(['fase' => 'grupo']);
        DB::table('jogos')->where('fase', 'semifinal')->update(['fase' => 'semi']);

        DB::statement("ALTER TABLE jogos MODIFY COLUMN fase ENUM(
            'grupo', 'oitavas', 'quartas', 'semi', 'terceiro', 'final'
        ) NOT NULL DEFAULT 'grupo'");
    }
};
