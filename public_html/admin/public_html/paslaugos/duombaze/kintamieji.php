<?php 
include("connect.php");
	///Admin.sql duomenys
	$admin = $con->QUERY("SELECT * FROM admin");
	$rows = $admin->fetch_All(MYSQLI_ASSOC);
	foreach ($rows as $row):
		$aname = $row['name'];
		$apas = $row['password'];
	endforeach;
	///Tinklapis.sql duomenys
	$nustatymai = $con->QUERY("SELECT * FROM tinklapis");
	$nrows = $nustatymai->fetch_All(MYSQLI_ASSOC);
	foreach ($nrows as $nrow):
		$title = $nrow['title'];
		$email = $nrow['elpastas'];
		$telnr = $nrow['telnr'];
		$skype = $nrow['skype'];
	endforeach;
	///Paysera.sql duomenys
	$paysera = $con->QUERY("SELECT * FROM paysera");
	$prows = $paysera->fetch_All(MYSQLI_ASSOC);
	foreach ($prows as $prow):
		$project = $prow['projectid'];
		$projectpass = $prow['sign_password'];
	endforeach;
	///Paslaugos.sql duomenys
	$paslaugos = $con->QUERY("SELECT * FROM paslaugos");
	$parows = $paslaugos->fetch_All(MYSQLI_ASSOC);
	foreach ($parows as $parow):
		$cid = $parow['cid'];
		$pavadinimas = $parow['pavadinimas'];
		$kaina = $parow['cid']."€";
		$laikas = $parow['laikas'];
		$raktazodis = $parow['raktazodis'];
		$numeris = $parow['numeris'];
		$cmdas = $parow['cmd'];
	endforeach;
	///Serveris.sql duomenys
	$serveris = $con->QUERY("SELECT * FROM serveris");
	$srows = $serveris->fetch_All(MYSQLI_ASSOC);
	foreach ($srows as $srow):
		$ipas = $srow['ip'];
		$portas = $srow['port'];
		$rconas = $srow['rcon'];
	endforeach;
	///SMS.sql 
	$smscon = $con->QUERY("SELECT * FROM sms");
	$smsrows = $smscon->fetch_All(MYSQLI_ASSOC);
	foreach ($smsrows as $smsrow):
		$kadabaigias = $smsrow['kadabaigsis'];
		$nickname = $smsrow['username'];
		$paslauga = $smsrow['paslauga'];
		$busena = $smsrow['busena'];
	endforeach;
	///Instaliacija
	if($project == "" or $projectpass == ""){
		$payserabusena = "Nenustatyta <span class='glyphicon glyphicon-remove'></span>";
		$p = 5;
	} else {
		$payserabusena = "Nustatyta <span class='glyphicon glyphicon-ok'></span>";
		$p = 35;
	}
	if($ipas == "" or $portas == "" or $rconas == ""){
		$serveriobusena = "Nenustatyta <span class='glyphicon glyphicon-remove'></span>";
		$s = 5;
	} else {
		$serveriobusena = "Nustatyta <span class='glyphicon glyphicon-ok'></span>";
		$s = 35;
	}
	if($aname != "default"){
		$adminduomenis = "Pakeista <span class='glyphicon glyphicon-ok'></span>";
		$a = 15;
	} else {
		$adminduomenis = "Nepakeista <span class='glyphicon glyphicon-remove'></span>";
		$a = 5;
	}
	if($title == "" or $email == ""){
		$tinklapiobusena = "Nepakeista <span class='glyphicon glyphicon-remove'></span>";
		$t = 5;
	} else {
		$tinklapiobusena = "Pakeista <span class='glyphicon glyphicon-ok'></span>";
		$t = 15;
	}
	$busenossuma = $p + $s + $a + $t;
?>