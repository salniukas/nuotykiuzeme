<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'discord_id', 'email', 'password','avatar', 'minecraft'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Check if the user has password set.
     *
     * @return boolean
     */
    public function hasPassword() {
        return ($this->password ? true : false);
    }

    public function changePassword($password) {
        self::update([
            "password" => bcrypt($password)
        ]);
    }

    //Patikrina Roles
    public function isAdmin()
    {
    if ($this->isAdmin) 
    {
         return true;
    } else {
        return false;
        }
    }
    public function isAleradas()
    {
    if ($this->isAleradas) 
    {
         return true;
    } else {
        return false;
        }
    }

    public function isSupport()
    {
    if ($this->isSupport) 
    {
         return true;
    } else {
        return false;
        }
    }

    public function isDonator()
    {
    if ($this->isDonator) 
    {
         return true;
    } else {
        return false;
        }
    }

    public function isAdded()
    {
    if ($this->isAdded) 
    {
         return true;
    } else {
        return false;
        }
    }

    public function Minecraft()
    {
    if ($this->minecraft) 
    {
         return true;
    } else {
        return false;
        }
    }

    //Pasiema Email
    public function getEmailAttribute($value)
    {
        return ($value);
    }
    //Pasiema DiscordID
    public function getdiscord_idAttribute($value)
    {
        return ($value);
    }
    //Pasiema admino statusą.
    public function getIsAdminAttribute($value)
    {
        return ($value);
    }

    public function getIsAleradasAttribute($value)
    {
        return ($value);
    }

    public function getIsSupportAttribute($value)
    {
        return ($value);
    }
    public function getAvatarAttribute($value)
    {
        return ($value);
    }
    public function getIsDonatorAttribute($value)
    {
        return ($value);
    }
    public function getIsAddedAttribute($value)
    {
        return ($value);
    }
    public function getminecraftAttribute($value)
    {
        return ($value);
    }
}