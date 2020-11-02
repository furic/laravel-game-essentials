<?php

namespace Furic\GameEssentials;

use Illuminate\Support\ServiceProvider;

class RedeemCodesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
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
        $this->app->make('furic\game-essentials\GameController');
        $this->app->make('furic\game-essentials\PlayerController');
        $this->app->make('furic\game-essentials\PlayerGameController');
        // $this->mergeConfigFrom(
        //     __DIR__ . '/../config/game-essentials.php', 'game-essentials'
        // );
    }
}
