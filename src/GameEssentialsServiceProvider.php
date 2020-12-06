<?php

namespace Furic\GameEssentials;

use Illuminate\Support\ServiceProvider;

class GameEssentialsServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/../migrations');
        // $this->publishes([
        //     __DIR__ . '/../config/game-essentials.php' => config_path('game-essentials.php'),
        // ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Furic\GameEssentials\Http\Controllers\GameController');
        $this->app->make('Furic\GameEssentials\Http\Controllers\PlayerController');
        $this->app->make('Furic\GameEssentials\Http\Controllers\PlayerGameController');
        // $this->mergeConfigFrom(
        //     __DIR__ . '/../config/game-essentials.php', 'game-essentials'
        // );
    }

}