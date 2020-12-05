<?php

use Illuminate\Support\Facades\Route;
use Furic\RedeemCodes\Http\Controllers\GameController;
use Furic\RedeemCodes\Http\Controllers\PlayerController;
use Furic\RedeemCodes\Http\Controllers\PlayerGameController;

// Games
Route::get('games/{id}', [GameController::class, 'show'])->name('games.show');
Route::get('games/{id}/versions', [GameController::class, 'showVersions'])->name('games.versions');

// Players
Route::get('players/{id}', [PlayerController::class, 'show'])->name('players.show');
Route::get('players/name/{name}', [PlayerController::class, 'showWithName'])->name('players.show-with-name');
Route::post('players', [PlayerController::class, 'create'])->name('players.create');
Route::put('players/{id}', [PlayerController::class, 'update'])->name('players.update');

// Player Games
Route::get('games/{id}/players', [PlayerGameController::class, 'showPlayers'])->name('games.players');