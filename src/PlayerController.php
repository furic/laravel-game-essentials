<?php

namespace Furic\GameEssentials;

use Player;
use PlayerGame;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlayerController extends Controller
{

    public function show($id)
    {
        return Player::findOrFail($id);
    }

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
        
        return $player;
    }
    
    public function showId($name)
    {
        $player = Player::findByName($name);
        return ["id" => $player->id];
    }

    public function showOnlineStatus(Request $request, $id)
    {
        $player = PlayerGame::findByPlayerGame($id, $request->playgames_id);
        return ["id" => $player->online_status];
    }
    
    public function update(Request $request, $id)
    {
        $player = Player::findOrFail($id);
        $player->update($request->all());
        return $player;
    }
}
