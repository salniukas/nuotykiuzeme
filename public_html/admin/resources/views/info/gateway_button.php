<?php

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

		$request = WebToPay::buildRequest(array(
		        // Čia surašyti tik keli parametrai.
		        // Visų galimų parametrų su aprašymais sąrašą rasite žemiau.
		        'projectid'     => 91781,
		        'sign_password' => 'a6c3c6da1dcdb03db03585d453d1d9b2',
				'orderid'		=> 0,
				'amount'		=> 300,
		        'country'       => 'LT',
            	'lang'          => 'LIT',
				'paytext'       => 'Parama [site_name] svetainei.',
		        'accepturl'     => $self_url.'/accept.php',
		        'cancelurl'     => $self_url.'/cancel.php',
		        'callbackurl'   => $self_url.'/callback.php',
		        'test'          => 1,
		    ));
	} catch (WebToPayException $e) {
		echo $e->getMessage();
	}

?>
<form method="post" action="<?php echo WebToPay::PAY_URL; ?>">
    <?php foreach ($request as $key => $val): ?>
    <input type="hidden" name="<?php echo $key ?>"
           value="<?php echo get_magic_quotes_gpc() ? $val : addslashes($val); ?>" /> 
    <?php endforeach; ?>
    <input type="image" border="0" name="submit"
           src="https://www.mokejimai.lt/payment/m/m_images/wfiles/i25zov101.gif"
           alt="Paremkite svetainę! - mokejimai.lt tai saugu ir patikima!" />
</form>
