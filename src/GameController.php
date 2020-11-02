<?php

namespace Furic\GameEssentials;

use Game;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GameController extends Controller
{

    public function show($id)
    {
        return Game::findOrFail($id);
    }

    public function showVersions($id) // Depricated
    {
        $game = Game::findOrFail($id);
        return ['ios' => $game->version_ios, 'android' => $game->version_android, 'tvos' => $game->version_tvos];
    }
}
