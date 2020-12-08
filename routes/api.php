<?php

use Illuminate\Support\Facades\Route;
use Furic\GameEssentials\Http\Controllers\GameController;
use Furic\GameEssentials\Http\Controllers\PlayerController;

// Games
Route::get('games/{id}', [GameController::class, 'show'])->name('games.show');
Route::get('games/{id}/versions', [GameController::class, 'showVersions'])->name('games.versions');
Route::get('games/{id}/players', [GameController::class, 'showPlayers'])->name('games.players');

// Players
Route::get('players/{id}', [PlayerController::class, 'show'])->name('players.show');
Route::get('players/name/{name}', [PlayerController::class, 'showWithName'])->name('players.show-with-name');
Route::post('players', [PlayerController::class, 'create'])->name('players.create');
Route::put('players/{id}', [PlayerController::class, 'update'])->name('players.update');
Route::get('players/{id}/games', [PlayerController::class, 'showGames'])->name('players.games');