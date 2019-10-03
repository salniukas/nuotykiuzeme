<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use WebToPay;
use \DiscordWebhooks\Client as DiscordWebhook;
use Paypal;

class PaymentController extends Controller
{

	// private $_apiContext;

 //    public function __construct()
 //    {
 //        $this->_apiContext = PayPal::ApiContext(
 //            config('services.paypal.client_id'),
 //            config('services.paypal.secret'));

 //        $this->_apiContext->setConfig(array(
 //            'mode' => 'live',
 //            'service.EndPoint' => 'https://api.paypal.com',
 //            'http.ConnectionTimeOut' => 30,
 //            'log.LogEnabled' => true,
 //            'log.FileName' => storage_path('logs/paypal.log'),
 //            'log.LogLevel' => 'FINE'
 //        ));

 //    }

   public function index()
   {
   	 return view('info.donate');
   }

   public function donate()
   {
      return view('info.select');
   }

   public function store(Request $request)
   {
   		Order::create(request(['username', 'email', 'amount', 'type']));
   		$order = Order::orderBy('created_at', 'DESC')->firstOrFail();
         $type = request('type');
         $pay = $order['amount'] / 100;
         // if ($type == "paysera") 
         // {
            return view('info.payment', ['order' => $order]);
      //    }elseif ($type == "paypal") 
      //    {
		    // $payer = PayPal::Payer();
		    // $payer->setPaymentMethod('paypal');

		    // $amount = PayPal::Amount();
		    // $amount->setCurrency('EUR');
		    // $amount->setTotal($pay);

		    // $transaction = PayPal::Transaction();
		    // $transaction->setInvoiceNumber(uniqid());
		    // $transaction->setAmount($amount);
		    // $transaction->setDescription('Perkate alerado žemės tinklapije');

		    // $redirectUrls = PayPal::RedirectUrls();
		    // $redirectUrls->setReturnUrl(route('getDone'));
		    // $redirectUrls->setCancelUrl(route('cancel'));

		    // $payment = PayPal::Payment();
		    // $payment->setIntent('sale');
		    // $payment->setPayer($payer);
		    // $payment->setRedirectUrls($redirectUrls);
		    // $payment->setTransactions(array($transaction));

		    // $response = $payment->create($this->_apiContext);
		    // $redirectUrl = $response->links[1]->href;

		    // return redirect()->to( $redirectUrl );
         
   }

 //   	public function getDone(Request $request)
	// {
	//     $id = $request->get('paymentId');
	//     $token = $request->get('token');
	//     $payer_id = $request->get('PayerID');

	//     $payment = PayPal::getById($id, $this->_apiContext);

	//     $paymentExecution = PayPal::PaymentExecution();

	//     $paymentExecution->setPayerId($payer_id);
	//     $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

	//     return redirect('accept');
	// }

   public function accept()
   {
      $order = Order::orderBy('created_at', 'DESC')->firstOrFail();
      $nick = $order['username'];
      $amount = $order['amount'] / 100;
      $status = $order->approved;
      $sent = $order->send;

      if ($status == "done" && $sent == 0) {
      	$message = "@everyone $nick Katik Paaukojo Alerado Žemei $amount €";
	    $discord = new DiscordWebhook('https://discordapp.com/api/webhooks/297755266768699403/xeyZysTlpRg0px9whcpWO2LfbcehGa_O7r9wTgMw4THzBowjowdilPjJfVb2LuZi1_S3');
	    $discord->avatar('http://i.imgur.com/olndxmt.png');
	    $discord->send($message);

	    $order->send = 1;
	    $order->save();

	    return view('info.accept');
      }else{
      	abort(404);
      }
   }

   public function cancel()
   {
      return view('info.cancel');
   }
}