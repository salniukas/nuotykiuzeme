<?php
	include("../duombaze/connect.php");
	include("../duombaze/kintamieji.php");
	require_once('WebToPay.php');
	require_once('rcon.php');

	try {
		$response = WebToPay::checkResponse($_GET, array(
			'projectid' => "$project",
			'sign_password' => "$projectpass",
		));

		echo "OK"; 

		$sms = strtolower ($response['key']);
		$info = explode(" ", $response['sms']);
		$username = $info[1];
		$paslaugose = "SELECT * FROM paslaugos";
		$isgauname = $con->query($paslaugose);

		if ($isgauname->num_rows > 0) {
			while($p = $isgauname->fetch_assoc()) {
				$cmds = str_replace('[nick]', $username, $p['cmd']); // Komandos pavertimas

				if($sms == $p['raktazodis']) {
					cmd('1', "$cmds");
					echo "OK Dėkojame $username."; ///// Atsakomoji zinute

					$dabar = date('Y-m-d H:i:s');
					$kadabaigsias = date('Y-m-d H:i:s', strtotime($dabar. "+ ".$p['laikas']." days"));

					if($username == "") echo ""; 
					else {
						$checkQuery = "SELECT * FROM sms WHERE username = '$username'";
						$result = $con->query($checkQuery);

						if ($result->num_rows < 1) {
							$irasom = "INSERT INTO sms(kadabaigsis, username, paslauga, busena) VALUES ('$kadabaigsias','$username', '".$p['pavadinimas']."', '1')";
							if ($con->query($irasom) === TRUE){
								$klaida = "";
							}
						}
					}
				}
			}
		}		
	}
	catch (Exception $e) {
		echo get_class($e).': '.$e->getMessage();
	}

	function cmd($server, $command) {
		include("../duombaze/connect.php");
		include("../duombaze/kintamieji.php");

		if($server == '1') {
			$server_ip = "$ipas";  ///// Serverio ip
			$server_rcon_port = "$portas";    ///// Serverio rcon port
			$server_rcon_password = "$rconas";  ///// Serverio rcon slaptažodis
		}

		require_once('rcon.php');

		$Rcon = new MinecraftRcon;

		try {
			$Rcon->Connect($server_ip, $server_rcon_port, $server_rcon_password);
			$command = $Rcon->Command($command);
			$Rcon->Disconnect();
		}
		catch( MinecraftRconException $e )
		{
			echo $e;
		}
	}
?>