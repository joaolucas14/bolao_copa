<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('palpites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('jogo_id')->constrained('jogos')->cascadeOnDelete();
            $table->unsignedTinyInteger('gols_brasil');
            $table->unsignedTinyInteger('gols_adversario');
            $table->decimal('pontuacao', 4, 1)->nullable();
            $table->boolean('pts_exato')->default(false);
            $table->boolean('pts_ganhador')->default(false);
            $table->boolean('pts_parcial')->default(false);
            $table->timestamps();

            $table->unique(['user_id', 'jogo_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('palpites');
    }
};
