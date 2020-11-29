<?php

namespace Furic\GameEssentials\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{

    protected $fillable = ['facebook_id', 'gamecenter_id', 'playgames_id', 'udid', 'name', 'ip'];

    public function games()
    {
        return $this->hasMany('App\PlayerGame');
    }

    public static function findByName($nameId)
    {
        return SELF::where('name', $nameId)->first();
    }
    
    public static function findByFacebookId($fbId)
    {
        return SELF::where('facebook_id', $fbId)->first();
    }

    public static function findByGameCenterId($gcId)
    {
        return SELF::where('gamecenter_id', $gcId)->first();
    }

    public static function findByPlayGamesId($pgId)
    {
        return SELF::where('playgames_id', $pgId)->first();
    }

    public static function findByUdid($udid)
    {
        return SELF::where('udid', $udid)->first();
    }
}
