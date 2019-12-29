<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
   protected $fillable = [
        'name', 'age', 'discord_id', 'email', 'kapl', 'kokia', 'kodel', 'kaip', 'mic', 'darbai', 'serv', 'content', 'subs', 'username'];

   public function votes()
    {
        return $this->hasMany('App\form_vote');
    }
}
