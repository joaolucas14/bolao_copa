<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracao extends Model
{
    protected $table = 'configuracoes';
    protected $primaryKey = 'chave';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['chave', 'valor'];

    public static function obter(string $chave, mixed $padrao = null): mixed
    {
        $config = static::find($chave);

        return $config ? $config->valor : $padrao;
    }

    public static function definir(string $chave, mixed $valor): void
    {
        static::updateOrCreate(
            ['chave' => $chave],
            ['valor' => $valor]
        );
    }
}
