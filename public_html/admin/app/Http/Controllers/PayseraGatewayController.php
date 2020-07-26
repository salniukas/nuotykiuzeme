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


class PayseraGatewayController extends Controller
{
	public function Start()
	{
		return view('pages.icons');

	}

    public function redirect (Request $request)
	{
		Order::create(request(['username', 'email', 'amount']));
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

		
		return response('OK', 200);
		return view('info.accept');
		}
	}

}
