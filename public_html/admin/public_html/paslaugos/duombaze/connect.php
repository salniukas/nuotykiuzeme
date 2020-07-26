<?php
	$con = mysqli_connect(
		"localhost", /// LocalHost
		"aus15862_bapserveris", /// Duomen� baz�s slapyvardis
		"Klaipeda123", /// Duomen� baz�s slapta�odis
		"aus15862_bap" /// duomen� baz�s lentel�s pavadinimas
	);
	if (mysqli_connect_errno()) {
	echo "[MySQL] Klaida: " . mysqli_connect_error();
	}
?>