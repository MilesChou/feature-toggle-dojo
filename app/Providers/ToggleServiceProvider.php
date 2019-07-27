<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MilesChou\Toggle\Factory;
use MilesChou\Toggle\Toggle;

class ToggleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Toggle::class, function () {
            return (new Factory)->createFromArray(config('toggle'));
        });
    }
}
