<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Authme extends Model
{
	protected $table = 'authme';

    protected $fillable = [
        'username', 'realname', 'password', 'ip', 'age', 'lastlogin', 'regdate', 'email'];

    protected $dates = ['regdate'];
}
