<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
   protected $fillable = [
        'title', 'description', 'author', 'yt'];
}
