<?php

namespace Furic\GameEssentials\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{

    protected $fillable = ['name', 'version_ios', 'version_android', 'version_tvos'];

    protected $hidden = ['created_at', 'updated_at'];

    public function players()
    {
        return $this->belongsToMany(Player::class);
    }

}