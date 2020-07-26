<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Player;
use Auth;
use App\user;

use \D3lph1\MinecraftRconManager\DefaultConnector;
use \D3lph1\MinecraftRconManager\Exceptions\ConnectSocketException;
use \D3lph1\MinecraftRconManager\Exceptions\AccessDenyException;
use Thedudeguy\Rcon;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user()->discord_id;
        $player = Player::where('discord_id', $user)->first();

        return view('profile.edit2', ['player' => $player]);
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // $user = Auth::user()->discord_id;
        // $player = Player::where('discord_id', $user)->first();
        // Player::find($player->id)->update($request->all());

        // return back()->withStatus(__('Profile successfully updated.'));

        $user = Auth::user()->discord_id;
        $player = Player::where('discord_id', $user)->first();

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
          $player->youtube = $request->get('youtube');
          $player->twitch = $request->get('twitch');
          $player->save();

          return redirect()->route('home')->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withStatusPassword(__('Password successfully updated.'));
    }
}
