<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forms_vote extends Model
{
   protected $fillable = ['voted_for', 'voter_discord', 'voter_name','reason'];
}
