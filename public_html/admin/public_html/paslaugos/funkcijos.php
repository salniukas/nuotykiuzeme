<?php
	function reload(){
		echo'<meta http-equiv="refresh" content="0; url=index.php">';
	}
	function liko($datestr){
		include("duombaze/connect.php");
		include("duombaze/kintamieji.php");
		$date=strtotime($datestr);
		$smsas = "SELECT * FROM sms";
		$isgaunamsms = $con->query($smsas);
			if ($isgaunamsms->num_rows > 0) {
			while($sms = $isgaunamsms->fetch_assoc()) {
		$dabar = $date-time();
		$dienos = floor($dabar/(60*60*24));
		$valandos = round(($dabar-$dienos*60*60*24)/(60*60));
		if($valandos < 1){
			$liko = "<span class='text-warning'><span class='glyphicon glyphicon-exclamation-sign'></span> Liko mažiau nei valanda</span>";
		} else if($valandos > $dabar){
			$irasom = "UPDATE sms SET busena = 0 WHERE kadabaigsis < '".$sms['kadabaigsis']."'";
			if ($con->query($irasom) === TRUE){
				$klaida = "";
			}
			$liko = "<span class='text-danger'><span class='glyphicon glyphicon-exclamation-sign'></span> Paslauga nuiimta</span>";
		} else {
			$liko = "<span class='text-success'><span class='glyphicon glyphicon-ok'></span> $dienos Dienų(-os), $valandos valandų(-os)</span>";
		}
		return $liko;
			}}
	}
?>