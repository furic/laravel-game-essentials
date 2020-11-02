<?php

namespace Furic\GameEssentials;

use Illuminate\Database\Eloquent\Model;

class PlayerGame extends Model
{

    protected $fillable = ['player_id', 'game_id', 'is_online', 'channel', 'version', 'is_hack'];

    public function player()
    {
        return $this->belongsTo('App\Player');
    }

    public static function findByPlayerGame($playerId, $gameId)
    {
        return SELF::where('player_id', $playerId)->where('game_id', $gameId)->first();
    }
    
    public static function getPlayers($gameId)
    {
        return SELF::where('game_id', $gameId);
    }
}
