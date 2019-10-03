<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\User;
use Auth;
use App\Player;
use Session;
use Carbon\Carbon;
use App\Form;



use \D3lph1\MinecraftRconManager\Connector;
use \D3lph1\MinecraftRconManager\Exceptions\ConnectSocketException;
use \D3lph1\MinecraftRconManager\Exceptions\AccessDenyException;


class PlayerAddController extends Controller
{
  public function register()
  {
      $userID = Auth::user()->discord_id;
      $user = Form::where(['discord_id' => $userID, 'aleradas' => 1])->get();
      if (Auth::user()->isAleradas && !Auth::user()->isAdded) {
         return view('player.add', ['user' => $user]);
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
        'veikla' => 'required|max:255',
        'rase' => 'required|max:255'
   		]);
      $user = User::where('discord_id', $request->discord_id)->first();
      $user->isAdded = 1;
      $user->save();

   		//Store
   		Player::create(request(['name', 'username', 'email', 'discord', 'age', 'veikla', 'rase', 'youtube', 'twitch']));

      //Add to Whitelist
      $username = $request->username;
      $connector = new Connector();

      try {
        $rcon = $connector->connect('51.255.124.101', 25575, 'Labuhas');
        }catch(ConnectSocketException $e) {
          //do smth...
        }catch(AccessDenyException $e) {
        // do something...
      }

      $response = $rcon->send('whitelist add '.$username);
      $rcon->disconnect();

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
      return redirect('zaidejai')->with('success', ['Žaidėjas sekmingai suspenduotas']);
    }

    public function atspenduoti($id)
    {
      $players = Player::find($id);
      $players->suspended = 0;
      $players->banned_at = null;
      $players->banned_until = null;
      $players->save();
      return redirect('zaidejai')->with('success', ['Žaidėjas sekmingai Atspenduotas']);
    }

    public function addAll()
    {
      $players = Player::where('suspended', 0)->get();
      $visi = Player::where('suspended', 0)->count();

      //rcon Connect

      $connector = new Connector();

      try {
        $rcon = $connector->connect('51.255.124.101', 25575, 'Labuhas');
        }catch(ConnectSocketException $e) {
          //do smth...
        }catch(AccessDenyException $e) {
        // do something...
      }
      foreach($players as $player){
        $username = $player->username;
        $response = $rcon->send('whitelist add '.$username);
      }
      $rcon->disconnect();

      return redirect('zaidejai')->with('success', [$visi.' Žaidėjai sekmingai pridėti']);
    }

    public function removeAll()
    {
      $players = Player::where('suspended', 0)->get();
      $visi = Player::where('suspended', 0)->count();

      //rcon Connect

      $connector = new Connector();

      try {
        $rcon = $connector->connect('51.255.124.101', 25575, 'Labuhas');
        }catch(ConnectSocketException $e) {
          //do smth...
        }catch(AccessDenyException $e) {
        // do something...
      }
      foreach($players as $player){
        $username = $player->username;
        $response = $rcon->send('whitelist remove '.$username);
      }
      $rcon->disconnect();

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
    	}
    	return redirect('zaidejai');
    }

    public function CheckSuspension()
    {
      $players = player::all();

        foreach ($players as $player) {
            if (Carbon::now()->toDateString() === $player->banned_until) {
                $player->suspended = 1;
                $player->banned_until = null;
                $player->banned_at = null;
                $player->save();
            }
        }
      return redirect('zaidejai');
    }


}
