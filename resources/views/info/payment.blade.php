@extends('layouts.app')
@section('content')
	@php

		require_once('WebToPay.php');

		function get_self_url() {
			$s = substr(strtolower($_SERVER['SERVER_PROTOCOL']), 0,
			            strpos($_SERVER['SERVER_PROTOCOL'], '/'));

			if (!empty($_SERVER["HTTPS"])) {
			    $s .= ($_SERVER["HTTPS"] == "on") ? "s" : "";
			}

			$s .= '://'.$_SERVER['HTTP_HOST'];

			if (!empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != '80') {
			    $s .= ':'.$_SERVER['SERVER_PORT'];
			}

			$s .= dirname($_SERVER['SCRIPT_NAME']);

			return $s;
		}

		try {
			$self_url = get_self_url();

			$request = WebToPay::redirectToPayment(array(
			        // Čia surašyti tik keli parametrai.
			        // Visų galimų parametrų su aprašymais sąrašą rasite žemiau.
			        'projectid'     => 91781,
			        'sign_password' => 'a6c3c6da1dcdb03db03585d453d1d9b2',
					'orderid'		=> $order['id'],
					'amount'		=> $order['amount'],
					'p_email'		=> $order['email'],
			        'country'       => 'LT',
					'paytext'       => 'Parama [site_name] svetainei.',
			        'accepturl'     => $self_url.'accept',
			        'cancelurl'     => $self_url.'cancel',
			        'callbackurl'   => $self_url.'callback.php',
			        'test'          => 0,
			    ));
		} catch (WebToPayException $e) {
			echo $e->getMessage();
		}
@endphp
@endsection