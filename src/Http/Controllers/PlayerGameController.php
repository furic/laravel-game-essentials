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
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPlayers(Request $request, $id)
    {
        $max = $request->max;
        $players = PlayerGame::getPlayers($id);
        if ($max <= 0) {
            return response($players->get(), 200);
        } else {
            return response($players->take($max)->get(), 200);
        } 
    }

}