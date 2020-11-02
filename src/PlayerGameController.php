<?php

namespace Furic\GameEssentials;

use PlayerGame;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlayerGameController extends Controller
{
    public function showPlayers(Request $request, $gameId)
    {
        $max = $request->max;
        $players = PlayerGame::getPlayers($gameId);
        if ($max <= 0) {
            return $players->get();
        } else {
            return $players->take($max)->get();
        } 
    }
}
