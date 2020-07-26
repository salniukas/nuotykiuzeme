<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use App\Order;
use Carbon\Carbon;
use App\Form;
use App\Player;
use App\Forms_vote;

use \D3lph1\MinecraftRconManager\DefaultConnector;
use \D3lph1\MinecraftRconManager\Exceptions\ConnectSocketException;
use \D3lph1\MinecraftRconManager\Exceptions\AccessDenyException;
use Thedudeguy\Rcon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        	$en = Carbon::now()->locale('lt');
        	$start = $en->startOfWeek()->format('Y-m-d H:i');
        	$end = $en->endOfWeek()->format('Y-m-d H:i');
        	$orderAmount = Order::whereBetween('created_at', [$start, $end])->where('Approved', 'done')->get();
        	$amount = 0;

        	foreach ($orderAmount as $amounts) {
        		$amount = $amount + $amounts->amount/100;
        	}

        	$forms = Form::where('sent', 0)->count();

        	$play = Player::all()->count();

        	$playw = Player::whereBetween('created_at', [$start, $end])->get();
        	$playwc = $playw->count();

            $user = Auth::user();

            $mano = Form::where('discord_id', $user->discord_id)->get();

            $orders = Order::orderBy('created_at', 'desc')->where('Approved', 'done')->where('email', Auth::user()->email)->get();

            return view('dashboard', ['amount' => $amount, 'forms' => $forms, 'play' => $play, 'playw' => $playw, 'playwc' => $playwc, 'mano' => $mano, 'orders' => $orders]);
        
    }

    public function Anketos()
    {
        if(Auth::user()->isAleradas()){
        	$forms = Form::where('sent', 0)->paginate(15);

            return view('users.anketos ',['forms' => $forms]);
        }
    }

    public function Atmestos()
    {
        if(Auth::user()->isAleradas()){
    	   $forms = Form::where('rejected', 1)->paginate(15);

            return view('users.anketos2',['forms' => $forms]);
        }
    }

    public function Patvirtintos()
    {
        if(Auth::user()->isAleradas()){
    	   $forms = Form::where('accepted', 1)->where('aleradas', 0)->paginate(15);

            return view('users.anketos3',['forms' => $forms]);
        }
    }

    public function show($id)
    {
    	$forms = Form::find($id);
        // $fafa = Forms_vote::where('voted_for', $id)->all();
        $balsaiu = Forms_vote::where('voted_for', $id)->where('reason', 'Už')->count();
        $balsaip = Forms_vote::where('voted_for', $id)->where('reason', 'Prieš')->count();
        $voted = Forms_vote::where('voter_discord', Auth::user()->discord_id)->where('voted_for', $id)->first();

        return view('profile.edit', ['forms' => $forms, 'balsaiu' => $balsaiu, 'balsaip' => $balsaip, 'voted' => $voted]);
    }

    public function players()
    {
        
        $players = Player::paginate(15);
        return view('pages.table_list', ['players' => $players]);
    }

    public function WhiteClear()
    {
    	$players = Player::where('suspended', 0)->get();

    	$host = env('Server_IP');
        $port = env('Server_PORT');
        $password = env('Server_PASS');
        $timeout = 3;                       // How long to timeout.
        $rcon = new Rcon($host, $port, $password, $timeout);

        foreach ($players as $player) {
        	if ($rcon->connect())
        	{
          		$rcon->sendCommand('whitelist add '.$player->username);
        	}
        }

        
    }
    public function BlackList()
    {
        $users = User::where('isBlacklist', 1)->paginate(15);
        return view('pages.table_list2', ['users' => $users]);
    }
}
