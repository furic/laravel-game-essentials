<?php

namespace Furic\GameEssentials\Models;

use Illuminate\Database\Eloquent\Model;

class GamePlayer extends Model
{

    protected $table = 'game_player';

    protected $fillable = ['game_id', 'player_id', 'is_online', 'channel', 'version', 'is_hack'];

    public static function findByGamePlayer($gameId, $playerId)
    {
        return SELF::where('player_id', $playerId)->where('game_id', $gameId)->first();
    }
    
}