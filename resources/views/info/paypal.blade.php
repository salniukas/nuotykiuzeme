@extends('layouts.app')
@section('content')
	@php
		require('/var/www/aleradozeme.lt/bootstrap.php');
		use PayPal\Api\Amount;
		use PayPal\Api\Details;
		use PayPal\Api\Item;
		use PayPal\Api\ItemList;
		use PayPal\Api\Payer;
		use PayPal\Api\Payment;
		use PayPal\Api\RedirectUrls;
		use PayPal\Api\Transaction;

		$k = $order['amount'];

		$payer = new Payer();
		$payer->setPaymentMethod("paypal");

		$item1 = new Item();
		$item1->setName('Alerado Žemės paketas $k €')
		    ->setCurrency('EUR')
		    ->setQuantity(1);
		// ### Amount
		// Lets you specify a payment amount.
		// You can also specify additional details
		// such as shipping, tax.
		$amount = new Amount();
		$amount->setCurrency("EUR")
		    ->setTotal($order['amount']);
		// ### Transaction
		// A transaction defines the contract of a
		// payment - what is the payment for and who
		// is fulfilling it. 
		$transaction = new Transaction();
		$transaction->setAmount($amount)
		    ->setItemList($item1)
		    ->setDescription("paslaugos aktyvuojamos per 12 valandų")
		    ->setInvoiceNumber($order['id']);
		// ### Redirect urls
		// Set the urls that the buyer must be redirected to after 
		// payment approval/ cancellation.
		$baseUrl = getBaseUrl();
		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl("$baseUrl/ExecutePayment.php?success=true")
		    ->setCancelUrl("$baseUrl/cancel");
		// ### Payment
		// A Payment Resource; create one using
		// the above types and intent set to 'sale'
		$payment = new Payment();
		$payment->setIntent("sale")
		    ->setPayer($payer)
		    ->setRedirectUrls($redirectUrls)
		    ->setTransactions(array($transaction));
		// For Sample Purposes Only.
		$request = clone $payment;
		// ### Create Payment
		// Create a payment by calling the 'create' method
		// passing it a valid apiContext.
		// (See bootstrap.php for more on `ApiContext`)
		// The return object contains the state and the
		// url to which the buyer must be redirected to
		// for payment approval
		try {
		    $payment->create($apiContext);
		} catch (Exception $ex) {
		    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
		    ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
		    exit(1);
		}
		// ### Get redirect url
		// The API response provides the url that you must redirect
		// the buyer to. Retrieve the url from the $payment->getApprovalLink()
		// method
		$approvalUrl = $payment->getApprovalLink();
		// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
		 ResultPrinter::printResult("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);
		return $payment;
@endphp
@endsection