<?php

namespace Furic\GameEssentials\Http\Controllers;

use Furic\GameEssentials\Models\Player;
use Furic\GameEssentials\Models\PlayerGame;
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
        return response(Player::findOrFail($id), 200);
    }

    /**
     * Show the form for creating a new player resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Check if an old player
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
        
        // Create playerGame if not exists
        if ($request->has('game_id')) {
            $playerGame = PlayerGame::findByPlayerGame($player->id, $request->game_id);
            if ($playerGame) {
                $playerGame->update($request->all());
            } else {
                $data = $request->all();
                $data['player_id'] = $player->id;
                PlayerGame::create($data);
            }
        }
        
        return response($player, 200);
    }
    
    /**
     * Display the ID of the player resource by a given name.
     *
     * @return \Illuminate\Http\Response
     */
    public function showId($name)
    {
        $player = Player::findByName($name);
        return response(["id" => $player->id], 200);
    }

    /**
     * Display the online status of the player resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showOnlineStatus(Request $request, $id)
    {
        $player = PlayerGame::findByPlayerGame($id, $request->playgames_id);
        return response(["id" => $player->online_status], 200);
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
        $player = Player::findOrFail($id);
        $player->update($request->all());
        return response($player, 200);
    }
}