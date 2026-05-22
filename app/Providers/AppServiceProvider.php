<?php

namespace App\Providers;

use App\Events\ResultadoRegistrado;
use App\Listeners\CalculaPontuacoes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Carbon::setLocale('pt_BR');
        setlocale(LC_TIME, 'pt_BR.UTF-8', 'pt_BR', 'portuguese');

        Event::listen(ResultadoRegistrado::class, CalculaPontuacoes::class);
    }
}
