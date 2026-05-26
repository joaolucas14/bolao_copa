<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Jogo extends Model
{
    const FASES = [
        'grupos'         => 'Fase de Grupos',
        'dezesseis_avos' => '16-avos de Final',
        'oitavas'        => 'Oitavas de Final',
        'quartas'        => 'Quartas de Final',
        'semifinal'      => 'Semifinal',
        'final'          => 'Final',
    ];

    protected $fillable = [
        'adversario',
        'foto_adversario',
        'data_hora',
        'fase',
        'gols_brasil',
        'gols_adversario',
        'penaltis',
        'status',
    ];

    protected $appends = ['foto_url'];

    protected function casts(): array
    {
        return [
            'data_hora' => 'datetime',
            'penaltis' => 'boolean',
            'gols_brasil' => 'integer',
            'gols_adversario' => 'integer',
        ];
    }

    public function getFotoUrlAttribute(): string
    {
        if ($this->foto_adversario && Storage::disk('public')->exists($this->foto_adversario)) {
            return Storage::url($this->foto_adversario);
        }

        return asset('images/escudo-padrao.svg');
    }

    public function palpites(): HasMany
    {
        return $this->hasMany(Palpite::class);
    }

    public function scopeAberto(Builder $query): Builder
    {
        return $query->where('status', 'aberto');
    }

    public function scopeEncerrado(Builder $query): Builder
    {
        return $query->where('status', 'encerrado');
    }

    public function scopeProximoJogo(Builder $query): Builder
    {
        return $query->where('status', 'aberto')
            ->whereNotNull('data_hora')
            ->orderBy('data_hora');
    }

    public function estaAberto(): bool
    {
        return $this->status === 'aberto';
    }

    public function estaEncerrado(): bool
    {
        return $this->status === 'encerrado';
    }

    public function palpitesBloqueados(): bool
    {
        if ($this->status !== 'aberto') {
            return true;
        }

        return $this->data_hora && now()->addHour()->greaterThanOrEqualTo($this->data_hora);
    }
}
