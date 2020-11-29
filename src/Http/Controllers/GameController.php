<?php

namespace Furic\GameEssentials\Http\Controllers;

use Game;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GameController extends Controller
{

    /**
     * Display the specified game resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return reponse(Game::findOrFail($id), 200);
    }

    /**
     * Display the versions of a specified game resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showVersions($id) // Depricated
    {
        $game = Game::findOrFail($id);
        return reponse(['ios' => $game->version_ios, 'android' => $game->version_android, 'tvos' => $game->version_tvos], 200);
    }

}
