<?php

namespace Furic\GameEssentials;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{

    protected $fillable = ['name', 'version_ios', 'version_android', 'version_tvos'];

}
