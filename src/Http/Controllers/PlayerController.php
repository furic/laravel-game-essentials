<?php

namespace Furic\GameEssentials\Http\Controllers;

use Furic\GameEssentials\Models\Player;
use Furic\GameEssentials\Models\GamePlayer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlayerController extends Controller
{

    /**
     * Display the specified player resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return response(Player::findOrFail($id), 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response([
                'error' => 'No player found.'
            ], 400);
        }
    }

    /**
     * Display the specified player resource with a given name.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function showWithName($name)
    {
        $player = Player::findByName($name);
        if ($player != NULL) {
            return response($player, 200);
        }
        return response([
            'error' => 'No player found.'
        ], 400);
    }

    /**
     * Store a newly created player resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Check if an old player
        $player = NULL;
        if ($request->has('facebook_id') && !empty($request->facebook_id)) {
            $player = Player::findByFacebookId($request->facebook_id);
        } else if ($request->has('playgames_id') && !empty($request->playgames_id)) {
            $player = Player::findByPlayGamesId($request->playgames_id);
        } else if ($request->has('gamecenter_id') && !empty($request->gamecenter_id)) {
            $player = Player::findByGameCenterId($request->gamecenter_id);
        } else if ($request->has('udid') && !empty($request->udid)) {
            $player = Player::findByUdid($request->udid);
        }
        
        // Create or update
        $data = $request->all();
        $data['ip'] = filter_input(INPUT_SERVER, "REMOTE_ADDR");
        if ($player) {
            $player->update($data);
        } else {
            $player = Player::create($data);
        }
        
        // Update/create GamePlayer entry if not exists
        if ($request->has('game_id')) {
            $playerGame = GamePlayer::findByGamePlayer($request->game_id, $player->id);
            if ($playerGame) {
                $playerGame->update($request->all());
            } else {
                $data = $request->all();
                $data['player_id'] = $player->id;
                GamePlayer::create($data);
            }
        }
        
        return response($player, 200);
    }
    
    /**
     * Update the specified player resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $player = Player::findOrFail($id);
            $player->update($request->all());
            // Update/create GamePlayer entry
            if ($request->has('game_id')) {
                $playerGame = GamePlayer::findByPlayerGame($request->game_id, $id);
                if ($playerGame) {
                    $playerGame->update($request->all());
                } else {
                    $data = $request->all();
                    $data['player_id'] = $player->id;
                    PlayerGame::create($data);
                }
            }
            return response($player, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response([
                'error' => 'No player found.'
            ], 400);
        }
    }

    /**
     * Display a listing of the game resource by a given player ID.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showGames(Request $request, $id)
    {
        try {
            if ($request->limit <= 0) {
                return response(Player::findOrFail($id)->games, 200);
            } else {
                return response(Player::findOrFail($id)->games->take($request->limit), 200);
            } 
         } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response([
                'error' => 'No player found.'
            ], 400);
        }
    }

}