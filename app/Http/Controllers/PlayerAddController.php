<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\User;
use Auth;
use App\Player;
use Session;
use Carbon\Carbon;
use App\Form;



use \D3lph1\MinecraftRconManager\DefaultConnector;
use \D3lph1\MinecraftRconManager\Exceptions\ConnectSocketException;
use \D3lph1\MinecraftRconManager\Exceptions\AccessDenyException;
use Thedudeguy\Rcon;

class PlayerAddController extends Controller
{
  public function register()
  {
      $userID = Auth::user()->discord_id;
      if (Auth::user()->isAleradas && !Auth::user()->isAdded) {
         return view('profile.edit3');
      }elseif(Auth::user()->isAdded){
        abort(422);
      }else{
        abort(403);
      }
  }

   public function store(Request $request)
   {
   		//validate
   		$this->validate(request(), [
        'name' => 'required|max:255',
        'username' => 'required|max:255',
        'email' => 'email|required|max:255',
        'discord' => 'required|max:255',
        'age' => 'required|max:255',
   		]);
      

   		//Store
   		Player::create(request(['name', 'username', 'email', 'discord', 'age', 'youtube', 'twitch', 'discord_id']));
   		$user = User::where('discord_id', $request->discord_id)->first();
      	$user->isAdded = 1;
      	$user->save();
      $player = Player::orderBy('created_at', 'DESC')->first();
      if (Auth::user()->isDonator) {
        $player->donator = 1;
        $player->save();
      }
      //Add to Whitelist
        $username = $request->username;
        $rase = $request->rase;

        $host = env('Server_IP');
        $port = env('Server_PORT');
        $password = env('Server_PASS');
        $timeout = 3;                       // How long to timeout.
        $rcon = new Rcon($host, $port, $password, $timeout);

        if ($rcon->connect())
        {
          $rcon->sendCommand('whitelist add '.$username);
          $rcon->sendCommand('team join '.$rase.' '.$username);
        }

      //redirect
   		return redirect('zaidejai')->with('success', ['Žaidėjas pridetas sekmingai!']);
   }
   	public function show($id)
   	{
   		if(Auth::user()->isAdmin()){
	   	 	$player = Player::find($id);
	   	 	return view('player.show', ['player' => $player]);
	   	}else{
	   		 	return view('errors.404');
	   		}
   		}
   	public function players()
   	{
	   	$players = Player::all();
	   	return view('player.list', ['players' => $players]);
	   		 
   	}

    public function suspenduoti($id)
    {
      $players = Player::find($id);
      $players->suspended = 1;
      $players->save();
      $username = $players->username;

        $host = env('Server_IP');
        $port = env('Server_PORT');
        $password = env('Server_PASS');
        $timeout = 3;                       // How long to timeout.
        $rcon = new Rcon($host, $port, $password, $timeout);

        if ($rcon->connect())
        {
          $rcon->sendCommand('ban '.$username.' Suspenduotas, 5 Baudos Taškai');
        }
      return redirect('zaidejai')->with('success', ['Žaidėjas sekmingai suspenduotas']);
    }

    public function atspenduoti($id)
    {
      $players = Player::find($id);
      $players->suspended = 0;
      $players->banned_at = null;
      $players->banned_until = null;
      $players->save();
      $username = $players->username;

        $host = env('Server_IP');
        $port = env('Server_PORT');
        $password = env('Server_PASS');
        $timeout = 3;                       // How long to timeout.
        $rcon = new Rcon($host, $port, $password, $timeout);

        if ($rcon->connect())
        {
          $rcon->sendCommand('pardon '.$username);
        }
      return redirect('zaidejai')->with('success', ['Žaidėjas sekmingai Atspenduotas']);
    }

    public function addAll()
    {
      $players = Player::where('suspended', 0)->get();
      $visi = Player::where('suspended', 0)->count();

      //rcon Connect

        $host = env('Server_IP');
        $port = env('Server_PORT');
        $password = env('Server_PASS');
        $timeout = 3;                       // How long to timeout.
        $rcon = new Rcon($host, $port, $password, $timeout);

        if ($rcon->connect())
        {
          $rcon->sendCommand('whitelist add '.$username);
        }

      return redirect('zaidejai')->with('success', [$visi.' Žaidėjai sekmingai pridėti']);
    }

    public function removeAll()
    {
      $players = Player::where('suspended', 0)->get();
      $visi = Player::where('suspended', 0)->count();

      //rcon Connect

        $host = env('Server_IP');
        $port = env('Server_PORT');
        $password = env('Server_PASS');
        $timeout = 3;                       // How long to timeout.
        $rcon = new Rcon($host, $port, $password, $timeout);

        if ($rcon->connect())
        {
          
          foreach($players as $player){
            $username = $player->username;
            $response = $rcon->sendCommand('whitelist remove '.$username);
          }
        }

      return redirect('zaidejai')->with('success', [$visi.' Žaidėjai sekmingai pašalinti']);
    }

    public function penality($id)
    {
    	$player = Player::find($id);
    	$player->kiekis = $player->kiekis + 1;
    	$player->save();
    	if ($player->kiekis >= 5) {
    		$player->banned_at = Carbon::now()->toDateString();
    		$player->banned_until = Carbon::now()->addWeeks(1)->toDateString();
    		$player->kiekis = 0;
    		$player->suspended = 1;
    		$player->save();
      	$username = $player->username;

        $host = env('Server_IP');
        $port = env('Server_PORT');
        $password = env('Server_PASS');
        $timeout = 3;                       // How long to timeout.
        $rcon = new Rcon($host, $port, $password, $timeout);

        if ($rcon->connect())
        {
          $rcon->sendCommand('ban '.$username.' Suspenduotas');
        }
      return redirect('zaidejai')->with('success', ['Žaidėjas sekmingai suspenduotas']);
    }
    }

    public function CheckSuspension()
    {
      $players = player::all();

        foreach ($players as $player) {
            if (Carbon::now()->toDateString() === $player->banned_until) {
                $player->suspended = 0;
                $player->banned_until = null;
                $player->banned_at = null;
                $player->save();

		      $username = $players->username;

		      $connector = new DefaultConnector();

		      try {
		        $rcon = $connector->connect('88.198.49.181', 25575, 'Liluputas321');
		        }catch(ConnectSocketException $e) {
		          //do smth...
		        }catch(AccessDenyException $e) {
		        // do something...
		      }

		      $response = $rcon->send('whitelist add '.$username);
		      $rcon->disconnect();
            }
        }
      return redirect('zaidejai');
    }

    public function edit()
    {   
        $discord_id = Auth::user()->discord_id;
        $player = Player::where('discord_id', $discord_id)->first();
        // return view('player.edit', compact('player'));
        return view('player.edit', ['player' => $player]);
    }

    public function update(Request $request)
    {
        $this->validate(request(), [
          'name' => 'required|max:255',
          'username' => 'required|max:255',
          'email' => 'email|required|max:255',
          'discord' => 'required|max:255',
          'age' => 'required|max:255',
          'veikla' => 'required|max:255',
          'rase' => 'required|max:255',
        ]);
          $id = $request->id;
          $player = player::find($id);
          $player->name = $request->get('name');
          if ($player->username != $request->username) {
            $host = env('Server_IP');
            $port = env('Server_PORT');
            $password = env('Server_PASS');
            $timeout = 3;                       // How long to timeout.
            $rcon = new Rcon($host, $port, $password, $timeout);

              if ($rcon->connect())
              {
                $rcon->sendCommand('whitelist add '. $request->username);
                $rcon->sendCommand('whitelist remove '. $player->username);
              }
          }

          $player->username = $request->get('username');
          $player->email = $request->get('email');
          $player->discord = $request->get('discord');
          $player->age = $request->get('age');
          $player->veikla = $request->get('veikla');

          if ($player->rase != $request->rase) {
            $host = env('Server_IP');
            $port = env('Server_PORT');
            $password = env('Server_PASS');
            $timeout = 3;                       // How long to timeout.
            $rcon = new Rcon($host, $port, $password, $timeout);

              if ($rcon->connect())
              {
                $rcon->sendCommand('team join '.$rase.' '.$username);
              }
          }

          $player->rase = $request->get('rase');
          $player->youtube = $request->get('youtube');
          $player->twitch = $request->get('twitch');
          $player->save();

          return redirect('zaidejai');
    }
}
