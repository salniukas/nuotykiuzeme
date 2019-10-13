<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Order;
use \DiscordWebhooks\Client;
use \DiscordWebhooks\Embed;
use App\User;
use Auth;

use \D3lph1\MinecraftRconManager\Connector;
use \D3lph1\MinecraftRconManager\Exceptions\ConnectSocketException;
use \D3lph1\MinecraftRconManager\Exceptions\AccessDenyException;


class OrderController extends Controller
{
	
	public function donate()
	{
	    return view('donate.select');
	}

	public function store($id)
	{	
		Order::create(request(['username', 'email', 'amount', 'type']));
		$order = Order::orderBy('created_at', 'DESC')->firstOrFail();

		return redirect('https://nuotykiuzeme.lt/donate/ready/'. $order->id);
	}
	public function ready($id)
	{
		$order = Order::find($id);
		return view('donate.pay')->with('order', $order);
	}

	public function paypal(Request $request){
      $response = array(
          'status' => 'success',
          'msg' => $request->message,
      );
      $id = $request->message;
      
      $order = Order::find($id);

      $order->approved = "done";
	  $order->save();

	  $project_id = $order->project_id;
	  $service_id = $order->service_id;
	  $service = Service::where('id', $service_id)->first();
	  $project = Project::where('id', $project_id)->first();
	  $username = $order->username;

	  $connector = new Connector();

	  try {
	    $rcon = $connector->connect($project->ip, $project->port, $project->pass);
	    }catch(ConnectSocketException $e) {
	    //do smth...
	    }catch(AccessDenyException $e) {
	    // do something...
	    }

	    $response = $rcon->send($project->cmd. ' '. $username . ' ' .$service->name);
	    $rcon->disconnect();

      return response()->json($response);


   }
}
