<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use App\Order;
use Carbon\Carbon;
use App\Authme;
use Illuminate\Http\Request;
use App\Service;

class PubController extends Controller
{


    public function players()
    {
        $players = Authme::paginate(15);
        return view('pages.table_list', ['players' => $players]);
    }
}
