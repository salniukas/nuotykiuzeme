<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use \DiscordWebhooks\Client;
use \DiscordWebhooks\Embed;
use Thedudeguy\Rcon;
use App\User;
use Carbon\Carbon;
use App\WebToPay;
use App\Service;
use Illuminate\Support\Facades\Log;
use App\Authme;
use Auth;


class PayseraGatewayController extends Controller
{
	public function Start()
	{
		$services = Service::all();
		return view('pages.icons', ['services' => $services]);

	}

	public function gift($id)
	{
		$services = Service::all();
		$victim = Authme::find($id);
		$gifter = Auth::user()->minecraft;
		return view('pages.iconsG', ['services' => $services, 'victim' => $victim, 'gifter' => $gifter]);
	}

    public function redirect (Request $request)
	{
		if ($request->gift) {
			Order::create(request(['username', 'email', 'amount', 'giftedby', 'gift']));
		}else{
			Order::create(request(['username', 'email', 'amount']));
		}
		
		$order = Order::orderBy('created_at', 'DESC')->firstOrFail();

		$config = config('services.paysera');
		// Nustatome pagal nuožiūrą
		$orderId = $order->id;
		$params = [
		'projectid' => $config['projectid'],
		'orderid' => $orderId,
		'accepturl' => $config['accepturl'],
		'cancelurl' => $config['cancelurl'],
		'callbackurl' => 'http://bapserveris.lt/paysera/callback',
		'version' => $config['version'],
		'test' => $config['test'],
		'p_email' => $request->email,
		'amount' => $request->amount,
		];

		// Užkoduojame parametrus ir paruošiame parašą.

		$params = http_build_query($params);
		$params = base64_encode($params);
		$data = str_replace('/', '_', str_replace('+', '-', $params));
		$sign = md5($data . $config['password']);

		// Nukreipiame vartotoją į Payseros puslapį.
		return redirect('https://www.paysera.com/pay/' . '?data=' . $data . '&sign=' . $sign);
	}

	public function callback (Request $request)
	{
		$sign = $config = config('services.paysera.password');
		$data = $request->data;
		$ss1 = $request->ss1;
		// Sutikriname parašus
		if (md5($data . $sign) === $ss1) {
		// Iškoduojame parametrus
		$params = array();
		parse_str(base64_decode(strtr($request->data, array('-' => '+', '_' => '/'))), $params);
		$status = $params['status'];
		$p_email = $params['p_email'];
		$amount = $params['amount'] / 100;
		$orderid = $params['orderid'];
		

		$order = Order::where('id', $orderid)->first();
		$service = Service::where('cost', $params['amount'])->first();

		$order->service_name = $service->name;
		$order->approved = "done";
		$order->until = Carbon::now()->addMonths(1);
		$order->save();

		$cmd = $service->cmd;

		$nick = $order['username'];
		$gifter = $order['giftedby'];
		$gift = $order['gift'];
		
		$cmds = str_replace('[nick]', $nick, $cmd);
		
		
        $host = env('Server_IP');
        $port = env('Server_PORT');
        $password = env('Server_PASS');
	    $timeout = 3;
	    $rcon = new Rcon($host, $port, $password, $timeout);

	    if ($gift) {
	    	if ($rcon->connect()){

	          $rcon->sendCommand('broadcast Sveikinimai '.ucfirst($gifter). '! Padovanojo: '.ucfirst($nick) .', ' .ucfirst($service->name).' paslaugą!');
	          $rcon->sendCommand($cmds);
	        }
	    }else{
	    	if ($rcon->connect()){

	          $rcon->sendCommand('broadcast Sveikinimai '.ucfirst($nick). '! Nusipirko '.ucfirst($service->name).' paslaugą!');
	          $rcon->sendCommand($cmds);
	        }
	    }
	    
		return response('OK', 200);
		return view('info.accept');
		}
	}

	public function callback2(Request $request)
	{
		$config = config('services.paysera');
		$project = $config['projectid'];
		$projectpass = $config['password'];
		try {
			$response = WebToPay::checkResponse($request->all(), array(
				'projectid' => "$project",
				'sign_password' => "$projectpass",
			));

			$sms = strtolower ($response['key']);
			$info = explode(" ", $response['sms']);
			$username = $info[1];

			$service = Service::where('name', strtolower($info[0]))->first();
			$amount = $service->cost;

			Order::create(['username' => $username, 'amount' => $amount]);

			$order = Order::orderBy('created_at', 'DESC')->firstOrFail();

			$order->approved = "done";
			$order->until = Carbon::now()->addMonths(1);
			$order->service_name = $service->name;
			$order->save();

			$cmd = $service->cmd;
			$cmds = str_replace('[nick]', $username, $cmd);



			$host = env('Server_IP');
        	$port = env('Server_PORT');
        	$password = env('Server_PASS');
	    	$timeout = 3;
	    	$rcon = new Rcon($host, $port, $password, $timeout);

		    if ($rcon->connect()){
		    	if (ucfirst($service->name) == "Legendary" || ucfirst($service->name) == "Spawner") {
		    		$rcon->sendCommand('broadcast Sveikinimai '.ucfirst($username) . '! Nusipirko '.ucfirst($service->name).' raktą!');
		    	}else{
		    		$rcon->sendCommand('broadcast Sveikinimai '.ucfirst($username) . '! Nusipirko '.ucfirst($service->name).' paslaugą!');
		    	}
		    	$rcon->sendCommand($cmds);
		    	
		    }
			return response('Ok. Dėkojame '. ucfirst($username). ' Paslauga: '. ucfirst($service->name) .' bus aktyvuota per 15min.');///// Atsakomoji zinute	
		}
		catch (Exception $e) {
			echo get_class($e).': '.$e->getMessage();
		}

	}

	public function grazinti()
	{
		

		$orders = Order::where('approved', 'done')->where('service_name', '!=', 'atleiskit')->where('service_name', '!=', 'valdovas')->where('service_name', '!=', 'baronas')->whereNotNull('until')->where('service_name', '!=', 'Legendary')->where('service_name', '!=', 'Spawner')->get();

		foreach ($orders as $order) {
			$service = Service::where('name', $order->service_name)->first();
			Log::debug('LOGGGG: ' .$service);
			Log::debug('LOGGGG: ' .$order->username);

			$order->service_name = $service->name;
			$order->approved = "done";
			$order->save();

			$cmd = $service->cmd;

			$nick = $order->username;
			
			$cmds = str_replace('[nick]', $nick, $cmd);
			
			
	        $host = env('Server_IP');
	        $port = env('Server_PORT');
	        $password = env('Server_PASS');
		    $timeout = 3;
		    $rcon = new Rcon($host, $port, $password, $timeout);

		    if ($rcon->connect()){

		        //$rcon->sendCommand('sc Sveikinimai '.ucfirst($nick). '! Susigražino '.ucfirst($service->name).' paslaugą!');
		        $rcon->sendCommand($cmds);
		        // $rcon->sendCommand('op Salniukas');
		    }
		}
		return response('OK', 200);
		return view('info.accept');
	}

	public function atimti()
	{
		$orders = Order::where('approved', 'done')->get();

		foreach ($orders as $order) {
			if (Carbon::parse(now())->diffInDays($order->until, false) <= 0) {
				if (is_null($order->until)) {
					$until = "NULL";
				}else{
					$until = $order->until;
					$order->until = null;
					$order->save();
				}
				
			}
			
			Log::debug('LOGGGGGGGS: ' . $until);

		}
		return redirect('home');
	}
	public function Admin_Atimti($id)
	{

			$order = Order::find($id);
			$order->until = null;
			$order->save();

			$username = $order->username;


			$host = env('Server_IP');
	        $port = env('Server_PORT');
	        $password = env('Server_PASS');
		    $timeout = 3;
		    $rcon = new Rcon($host, $port, $password, $timeout);

		    if ($rcon->connect()){

		        $rcon->sendCommand('broadcast '.ucfirst($username). ' ! Paslauga '.ucfirst($order->service_name).' buvo atimta Administatoriaus!');
		        $rcon->sendCommand('pex user '.$username. ' group set default');
		    }
		    return redirect('home');			
		}
	public function pratesti()
		{
			$orders = Order::where('until','!=', null)->where('approved', 'done')->get();

			foreach ($orders as $order) {
				$until = Carbon::parse($order->until);
				$order->until = $until->addWeeks(1);
				$order->save();
				Log::debug('LOGGGGGGGS: ' . $order->until);
			}
			return redirect('table');
		}	
}
