<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
   protected $fillable = [
        'name', 'age', 'discord_id', 'email', 'roleplay', 'rases', 'kokios', 'kodel', 'kaip', 'username'];

   public function votes()
    {
        return $this->hasMany('App\form_vote');
    }
}
