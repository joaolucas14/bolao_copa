<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Palpite extends Model
{
    protected $fillable = [
        'user_id',
        'jogo_id',
        'gols_brasil',
        'gols_adversario',
        'pontuacao',
        'pts_exato',
        'pts_ganhador',
        'pts_parcial',
    ];

    protected function casts(): array
    {
        return [
            'gols_brasil' => 'integer',
            'gols_adversario' => 'integer',
            'pontuacao' => 'float',
            'pts_exato' => 'boolean',
            'pts_ganhador' => 'boolean',
            'pts_parcial' => 'boolean',
        ];
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jogo(): BelongsTo
    {
        return $this->belongsTo(Jogo::class);
    }
}
