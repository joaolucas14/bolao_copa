<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jogos', function (Blueprint $table) {
            $table->id();
            $table->string('adversario')->nullable();
            $table->dateTime('data_hora')->nullable();
            $table->enum('fase', [
                'grupo',
                'oitavas',
                'quartas',
                'semi',
                'terceiro',
                'final',
            ])->default('grupo');
            $table->unsignedTinyInteger('gols_brasil')->nullable();
            $table->unsignedTinyInteger('gols_adversario')->nullable();
            $table->boolean('penaltis')->default(false);
            $table->enum('status', ['agendado', 'aberto', 'encerrado'])->default('agendado');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jogos');
    }
};
