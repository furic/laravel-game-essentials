<?php

namespace Furic\GameEssentials\Http\Controllers;

use Furic\GameEssentials\Models\PlayerGame;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlayerGameController extends Controller
{

    /**
     * Display a listing of the player resource by a given game ID.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPlayers(Request $request, $gameId)
    {
        $max = $request->max;
        $players = PlayerGame::getPlayers($gameId);
        if ($max <= 0) {
            return response($players->get(), 200);
        } else {
            return response($players->take($max)->get(), 200);
        } 
    }

}
