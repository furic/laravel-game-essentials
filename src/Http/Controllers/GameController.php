<?php

namespace Furic\GameEssentials\Http\Controllers;

use Furic\GameEssentials\Models\Game;
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
        try {
            return response(Game::findOrFail($id), 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response([
                'error' => 'No game found.'
            ], 400);
        }
    }

    /**
     * Display the versions of a specified game resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showVersions($id) // Depricated
    {
        try {
            $game = Game::findOrFail($id);
            return response([
                'ios' => $game->version_ios,
                'android' => $game->version_android,
                'tvos' => $game->version_tvos
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response([
                'error' => 'No game found.'
            ], 400);
        }
    }

    /**
     * Display a listing of the player resource by a given game ID.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPlayers(Request $request, $id)
    {
        try {
            if ($request->limit <= 0) {
                return response(Game::findOrFail($id)->players, 200);
            } else {
                return response(Game::findOrFail($id)->players->take($request->limit), 200);
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response([
                'error' => 'No game found.'
            ], 400);
        }
    }

}