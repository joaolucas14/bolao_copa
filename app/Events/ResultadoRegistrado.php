<?php

namespace App\Events;

use App\Models\Jogo;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ResultadoRegistrado
{
    use Dispatchable, SerializesModels;

    public function __construct(public readonly Jogo $jogo) {}
}
