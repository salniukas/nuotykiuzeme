<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'name', 'username', 'email', 'discord', 'age', 'youtube', 'twitch', 'discord_id'];
}
