<?php session_start();
require_once("../duombaze/connect.php");
require_once("../funkcijos.php");
require_once("../duombaze/kintamieji.php");
?>
<?php
	$nick = $_SESSION['admin'];
	
	if(isset($_GET['id'])){
		$id = $_GET['id'];
	} else {
		$id = "";
	}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/stilius.css" rel="stylesheet">
	<style>
	div.tooltip-inner {
		max-width: 350px;
	}
	.progress{
		height: 20px;
	}
	.progress-bar{
		height: 20px;
		padding-top: 5px;
	}
	</style>
  </head>
<body style="background: url('../img/bg.jpg') no-repeat fixed 50% 0 rgb(20,20,20);">
    <br>
    <br>
	<div class="container">
		<div class="row">
			<div class="col-md-1"></div>
				<div class="col-md-3">
					<div class="well">
						<?php if(isset($_SESSION["admin"]) && $_SESSION["admin"]){ ?>
								<ul id="sidebar" class="nav nav-pills nav-stacked">
									<center>
									<p class="bg-success apvalus">Navigacija </p>		
									</center>
									<li><a href="index.php"><span class="glyphicon glyphicon-star-empty"></span>  Instaliavimas</a></li>
									<li><a href="?atsijungti=1"><span class="glyphicon glyphicon-log-out"></span> Atsijungti</a></li>
									<hr>
									<center>
									<p class="bg-success apvalus">Nustatymai</p>		
									</center>
									<li><a href="index.php?id=serveris"><span class="glyphicon glyphicon-cog"></span>  Pridėti serverį</span></a> </li>
									<li><a href="index.php?id=paysera"><span class="glyphicon glyphicon-pencil"></span>  Paysera nustatymai</span></a> </li>
									<li><a href="index.php?id=weboptions"><span class="glyphicon glyphicon-envelope"></span>  Tinklapio nustatymai</span></a> </li>
									<li><a href="index.php?id=adminsettings"><span class="glyphicon glyphicon-user"></span>  Admin nustatymai</span></a> </li>
									<li><a href="index.php?id=newservice"><span class="glyphicon glyphicon-star-empty"></span>  Nauja paslauga</span></a> </li>
									<li><a href="index.php?id=deleteservice"><span class="glyphicon glyphicon-star-empty"></span>  Ištrinti paslauga</span></a> </li>
									<li><a href="index.php?id=setcmd"><span class="glyphicon glyphicon-tasks"></span>  Nustatyti cmd komandas</span></a> </li>
									<li class="disabled"><a href="#"><span class="glyphicon glyphicon-pencil"></span>  Žaidėjai su paslaugom</span><span class="badge">Kitam atnaujinime</span></a> </li>
								</ul>
							<?php } else { ?>
								<ul id="sidebar" class="nav nav-pills nav-stacked">
									<center>
									<p class="bg-success apvalus">Admin Navigacija</p>		
									</center>
									<hr>
										<li><a href="../../"><span class="glyphicon glyphicon-log-out"></span>  Pagrindinis</a></li>
										<li><a href="../"><span class="glyphicon glyphicon-log-out"></span>  Atgal į paslaugas</a></li>
									<hr>
								</ul>
							<?php } ?>
					</div>
				</div>
		<div class="col-md-7">
			<div class="well">
				<?php if(isset($_SESSION["admin"]) && $_SESSION["admin"]){?>
						<?php if($id == ""){ ?>
						<table class="table table-striped table-bordered">
							<tbody>
								<tr><th>Nustatymas</th><td><b>Būsena</b> </td></tr>
								<tr><th>*Nustatyk paysera duomenis</th><td><?php echo $payserabusena; ?></td></tr>
								<tr><th>*Nustatyk serverį</th><td><?php echo $serveriobusena; ?></td></tr>
								<tr><th>*Pakeisk admino duomenis</th><td><?php echo $adminduomenis; ?></td></tr>
								<tr><th>Pakeisk tinklapio duomenis</th><td><?php echo $tinklapiobusena;?></td></tr>
							</tbody>
						</table>
						<div class="progress progress-striped active">
						  <div class="progress-bar progress-bar-danger" style="width: <?php echo $busenossuma; ?>%; font-size: 20px;"><?php echo $busenossuma; ?>%</div>
						</div>
						<h5 class="text-danger">Sistema neveiks pilnai tol, kol progresas nepasieks galo</h5>
						<h5 class="text-danger">ženkliukas <b>*</b> reiškia, kad yra privaloma</h5>
						<?php }if($id == "serveris"){ ?>
							<form method="POST">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"> <span class="badge" data-toggle="tooltip" title="Serverio IP adresas">?</span></span>
										<input type="text" class="form-control" name="ip" placeholder="Ip adresas">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"> <span class="badge" data-toggle="tooltip" title="Serverio Rcon port">?</span></span>
										<input type="text" class="form-control" name="port" placeholder="Rcon port adresas">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"> <span class="badge" data-toggle="tooltip" title="Serverio rcon slaptažodis">?</span></span>
										<input type="text" class="form-control" name="rcon" placeholder="Rcon slaptažodis">
									</div>
								</div>
								<button type="submit" class="btn btn-info" name="serveris">Keisti</button>
							<?php 
								if(isset($_POST['serveris'])){
									$ip = trim(mysqli_escape_string($con,$_POST['ip']));
									$port = trim(mysqli_escape_string($con,$_POST['port']));
									$rcon = trim(mysqli_escape_string($con,$_POST['rcon']));
									if($ip == "" OR $port == "" OR $rcon == ""){ $klaida = "Paliktas tusčias laukelis..";}
									else {
										if($ipas == ""){
											$irasom = "INSERT INTO serveris(ip, port, rcon) VALUES ('$ip','$port', '$rcon')";
										} else {
											$irasom = "UPDATE serveris SET ip='$ip', port='$port', rcon='$rcon'";
										}
										if ($con->query($irasom) === TRUE){
											$klaida = "Serveris pridėtas";
										}
									}
									echo $klaida;
								}
							?>
							</form>
						<?php } if($id == "weboptions"){ ?>
						<table class="table table-striped table-bordered" id="kintamieji">
								<tbody>
									<tr><th>Dabartiniai duomenys</th><td><b> -</b> </td></tr>
									<tr><th>Tinklapio title</th><td> <?php echo $title;?></td></tr>
									<tr><th>El.paštas</th><td><?php echo $email;?></td></tr>
									<tr><th>Skype</th><td><?php echo $skype;?></td></tr>
									<tr><th>Tel nr.</th><td><?php echo $telnr;?></td></tr>
								</tbody>
							</table>
							<form method="POST">
								<div class="form-group">
									<div class="input-group">
									 <span class="input-group-addon"> <span class="badge" data-toggle="tooltip" title="Nurodyti puslapio antraštę">?</span></span>
										<input type="text" class="form-control" name="title" placeholder="Tinklapio pavadinimas">
									  </div>
								</div>
								<div class="form-group">
									<div class="input-group">
									 <span class="input-group-addon"> <span class="badge" data-toggle="tooltip" title="El.paštas pagal paysera turi būti privalomai nurodytas paslaugų pirkėjam">?</span></span>
										<input type="text" class="form-control" name="email" placeholder="Tinklapyje rodomas el.pašto adresas">
									  </div>
								</div>
								<div class="form-group">
									<div class="input-group">
									 <span class="input-group-addon"> <span class="badge" data-toggle="tooltip" title="Jūsų skype">?</span></span>
										<input type="text" class="form-control" name="skype" placeholder="Tinklapyje rodomas skype">
									  </div>
								</div>
								<div class="form-group">
									<div class="input-group">
									 <span class="input-group-addon"> <span class="badge" data-toggle="tooltip" title="Tel nr. pagal paysera turi būti būtinai nurodytas">?</span></span>
										<input type="text" class="form-control" name="telnr" placeholder="Tinklapyje rodomas telefono numeris">
									  </div>
								</div>
								<button type="submit" class="btn btn-info" name="nustatymai">Keisti</button>
								<?php 
									if(isset($_POST['nustatymai'])){
										$titles = trim(mysqli_escape_string($con,$_POST['title']));
										$emails = trim(mysqli_escape_string($con,$_POST['email']));
										$skypes = trim(mysqli_escape_string($con,$_POST['skype']));
										$telnrs = trim(mysqli_escape_string($con,$_POST['telnr']));
										if($titles == ""){ $titles = $title; }
										if($emails == ""){ $emails = $email; }
										if($skypes == ""){ $skypes = $skype; }
										if($telnrs == ""){ $telnrs = $telnr; }
										$irasom = "UPDATE tinklapis SET title='$titles', elpastas='$emails', telnr='$telnrs', skype='$skypes'";
										if ($con->query($irasom) === TRUE){
											reload();
										}
									}
									echo $klaida;
								?>
							</form>
						<? } if($id == "adminsettings"){ ?>
							<form method="POST" action="index.php?id=adminsettings">
								<div class="form-group">
									<div class="input-group">
									 <span class="input-group-addon"> <span class="badge" data-toggle="tooltip" title="Naujas administratoriaus slapyvardis">?</span></span>
										<input type="text" class="form-control" name="newnick" placeholder="Naujas slapyvardis">
									  </div>
								</div>
								<div class="form-group">
									<div class="input-group">
									 <span class="input-group-addon"> <span class="badge" data-toggle="tooltip" title="Naujas administratoriaus slaptažodis">?</span></span>
										<input type="password" class="form-control" name="newpass" placeholder="Naujas slaptažodis">
									  </div>
								</div>
								<button type="submit" class="btn btn-info" name="changeadmin">Keisti</button>
								<?php 
									if(isset($_POST['changeadmin'])){
										$newnick = trim(mysqli_escape_string($con,$_POST['newnick']));
										$newpass = trim(mysqli_escape_string($con,$_POST['newpass']));
										$newpasscode = hash('sha512', $newpass);
										if($newnick == "" or $newpass == ""){ $klaida = "Duomenys nepakeisti, nes paliktas tusčias laukelis";}
										else {
										$irasom = "UPDATE admin SET name='$newnick', password='$newpasscode'";
											if ($con->query($irasom) === TRUE){
												reload();
											}
										$klaida = "Duomenys sėkmingai pakeisti";
										}
									}
									echo $klaida;
								?>
							</form>
						<?php } if($id == "paysera"){ ?>
							<form method="POST" action="index.php?id=paysera">
								<div class="form-group">
									<div class="input-group">
									 <span class="input-group-addon"> <span class="badge" data-toggle="tooltip" title="Projekto id">?</span></span>
										<input type="text" class="form-control" name="projectid" placeholder="Projekto id">
									  </div>
								</div>
								<div class="form-group">
									<div class="input-group">
									 <span class="input-group-addon"> <span class="badge" data-toggle="tooltip" title="Projekto slaptažodis">?</span></span>
										<input type="password" class="form-control" name="projectpassword" placeholder="Projeto slaptažodis">
									  </div>
								</div>
								<button type="submit" class="btn btn-info" name="paysera">Nustatyti</button>
							<?php
								if(isset($_POST['paysera'])){
										$projectid = trim(mysqli_escape_string($con,$_POST['projectid']));
										$projectpassword = trim(mysqli_escape_string($con,$_POST['projectpassword']));
										if($projectid == "" or $projectpassword == ""){ $klaida = "Duomenys nenustatyti, nes paliktas tusčias laukelis";}
										else {
											if($project == "" or $projectpass == ""){
												$irasom = "INSERT INTO paysera(projectid, sign_password) VALUES ('$projectid','$projectpassword')";
											} else {
												$irasom = "UPDATE paysera SET projectid='$projectid', sign_password='$projectpassword'";
											}
											if ($con->query($irasom) === TRUE){
												$klaida = "Projekto duomenys įrašyti";
											}
										}
									}
									echo $klaida;
							?>
						<?php } if($id == "newservice"){ ?>
							<form method="POST" onSubmit="window.location.reload()">
							<p class="badge">Sukūrus paslaugą nueikite į skiltį paslaugų komandos ir nustatykite šios paslaugos cmd komandas</p>
								<div class="form-group">
									<div class="input-group">
									 <span class="input-group-addon"> <span class="badge" data-toggle="tooltip" title="Trumpas paslaugos pavadinimas pvz.: VIP, SuperVip">?</span></span>
										<input type="text" class="form-control" name="paslauga" placeholder="Paslaugos pavadinimas">
									 </div>
								</div>
								<div class="form-group">
									<div class="input-group">
									 <span class="input-group-addon"> <span class="badge" data-toggle="tooltip" title="Raktažodžio kaina pvz.: 0.29, 1, 1.5 ir t.t.">?</span></span>
										<input type="text" class="form-control" name="kaina" placeholder="Paslaugos kaina, nerašykite € simbolio, tik skaičių">
									 </div>
								</div>
								<div class="form-group">
									<div class="input-group">
									 <span class="input-group-addon"> <span class="badge" data-toggle="tooltip" title="Rašyti tik dienų skaičių, pvz.: 30,14 ir t.t. čia nebus laikui uždėta paslauga, kad laikui uždėt reikia nustatyt per 'Nustatyti cmd komandas'">?</span></span>
										<input type="text" class="form-control" name="laikas" placeholder="Nurodyk žaidėjam kiek dienų bus uždėta paslauga, jei paslauga vienkartine, nieko nerašykit, atvaizduos kaip VISAM">
									 </div>
								</div>
								<div class="form-group">
									<div class="input-group">
									 <span class="input-group-addon"> <span class="badge" data-toggle="tooltip" title="Raktažodis, pvz.: mcvip">?</span></span>
										<input type="text" class="form-control" name="raktazodis" placeholder="Raktažodis">
									 </div>
								</div>
								<div class="form-group">
									<div class="input-group">
									 <span class="input-group-addon"> <span class="badge" data-toggle="tooltip" title="Numeris, pvz.: 1398">?</span></span>
										<input type="text" class="form-control" name="numeris" placeholder="Numeris kuriuo bus siunčamas raktažodis">
									 </div>
								</div>
								<div class="form-group">
									<div class="input-group">
									 <span class="input-group-addon"> <span class="badge" data-toggle="tooltip" title="Galima įrašyti papildoma informacija pvz.: Paslauga bus uždėta iškarto, norintys įsigyti banku rašykite į skype">?</span></span>
										<input type="text" class="form-control" name="subtekstas" placeholder="Subtekstas">
									 </div>
								</div>
								<div class="form-group required-field-block">       
									<div class="col-md-12 input-group">
										<textarea rows="3" size="30" name="galimybes" class="form-control" placeholder="Ką gaus žaidėjas nusipirkes šią paslauga paslaugas atskirti reikia per <li> žymes </li> pvz.: <li> Užrašas VIP - [name] </li>"></textarea>  
									</div>
								</div>
								<button type="submit" class="btn btn-info" name="naujapaslauga">Sukurti paslauga</button>
							</form>
							<h4>Galimi kintamieji </h4>
							<p class="text-info"> [nick] - Atvaizduos žaidėjo nick paslaugų sąraše</p>
							<?Php 
								if(isset($_POST['naujapaslauga'])){
									$paslauga = trim(mysqli_escape_string($con, $_POST['paslauga']));
									$kaina = trim(mysqli_escape_string($con, $_POST['kaina']));
									$laikas = trim(mysqli_escape_string($con, $_POST['laikas']));
									$raktazodis = trim(mysqli_escape_string($con, $_POST['raktazodis']));
									$numeris = trim(mysqli_escape_string($con, $_POST['numeris']));
									$subtekstas = trim(mysqli_escape_string($con, $_POST['subtekstas']));
									$galimybes = $_POST['galimybes'];
									
									if($paslauga == "" OR $kaina == "" or $raktazodis == "" or $numeris == "" or $galimybes == ""){ $klaida = "Būtina užpildyti laukelius: Pavadinimas, kaina, raktazodis, numeris, galimybes";}
									else {
										$irasom = "INSERT INTO paslaugos(pavadinimas, kaina, laikas, raktazodis, numeris, galimybes, subtekstas) VALUES ('$paslauga','$kaina', '$laikas', '$raktazodis', '$numeris', '$galimybes', '$subtekstas')";
										if ($con->query($irasom) === TRUE){
											$klaida = "Paslauga sėkmingai sukurta, dabar nueik nustatyt paslaugos cmd komandas";
										}
									}
								}
								echo $klaida;
							?>
						<?php } if($id == "deleteservice"){ 
								$paslaugos = "SELECT * FROM paslaugos";
								$isgaunam = $con->query($paslaugos);
								if ($isgaunam->num_rows > 0) {
									echo '  
									<form method="POST">
											<div class="form-group">
										<div class="input-group">
										 <span class="input-group-addon"> <span class="badge" data-toggle="tooltip" title="Pasirinkite paslauga kurią norite ištrinti">?</span></span>
											<select class="form-control" name="trinam">';
										while($p = $isgaunam->fetch_assoc()) {
											echo '<option value="'.$p['cid'].'">ID:'.$p['cid'].' - '.$p['pavadinimas'].' / Kaina '.$p['kaina'].'€</option>';
										}
											echo'</select>
										</div>
									</div>
									<button type="submit" class="btn btn-info" name="remove">Ištrinti</button>
									</form>
									';
								} else {
									echo 'Paslaugų nėra';
								}
							if(isset($_POST['remove'])){
								$trinam = $_POST['trinam'];
								$delete = "DELETE FROM paslaugos WHERE cid = '$trinam'";
								if($trinam == ""){ $klaida = ""; }
								else {
									if($con->query($delete) === TRUE){
											$klaida = "Paslauga ištrinta, perkraukite puslapi, kad nebesimatytu ištrinta paslauga";
									}
								}
								echo $klaida;
							}
						?>
						<?php } if($id == "setcmd"){
								$paslaugos = "SELECT * FROM paslaugos";
								$isgaunam = $con->query($paslaugos);
								if ($isgaunam->num_rows > 0) {
									
								echo '  <form method="POST" onSubmit="window.location.reload()">
										<div class="form-group">
									<div class="input-group">
									 <span class="input-group-addon"> <span class="badge" data-toggle="tooltip" title="Pasirinkite paslauga kuriai nustatoma cmd komanda">?</span></span>
										<select class="form-control" name="id">';
									while($p = $isgaunam->fetch_assoc()) {
										echo '<option value="'.$p['cid'].'">ID:'.$p['cid'].' - '.$p['pavadinimas'].' / Kaina '.$p['kaina'].'€</option>';
									}
										echo'</select>
									</div>
								</div>';
								}
						?>
								<div class="form-group">
									<div class="input-group">
									 <span class="input-group-addon"> <span class="badge" data-toggle="tooltip" title="CMD komanda kuri bus įvykdoma įvykus sms išsiuntimui">?</span></span>
										<input type="text" class="form-control" name="cmd" placeholder='pex user [nick] group add vip "" 2592000'>
									 </div>
								</div>
								<button type="submit" class="btn btn-info" name="setcmd">Nustatyti komandą</button>
								
								<h4><br>Pagalba kuriant komandas</h4>
								<p class="text-warning">1. Svarbiausia yra nustatyti kintamajį <b>[nick]</b> rašant komandą, kitaip sistema nežinos kam uždėti nustatytą komandą</p>
								<p class="text-success">2. Komandos pavyzdys:<br> <b>pex user [nick] group add vip "" 2592000</b><br>Štai šį komandą ivykdis vip uždėjima mėnesio laikotarpiui, būtinos kabūtes, jos reiškia kad ta paslauga bus uždėta visuose pasauliuose t.y. World, Nether ir kt.</p>
								<p class="text-success">3. Komandos nebūtinai turi būti tokios, kad tik paslaugom uždėt, gali būti ir:<br><b> gamemode 1 [nick] - Uždės gamemode<br> pardon [nick] - Atblokuos žaidėją</b></p>
								<p class="text-success">3. Rašyti vienu kartu vieną komanda, komandų pridėti galima N kartų vienai paslaugai</p>
							<?Php 
								if(isset($_POST['setcmd'])){
									$cid = $_POST['id'];
									$cmd = $_POST['cmd'];
									
									if($cmd == ""){ $klaida = "Įrašyk komandą";}
									else {
										$irasom = "UPDATE paslaugos SET cmd='$cmd' WHERE cid = '$cid'";
										if ($con->query($irasom) === TRUE){
											$klaida = "CMD komanda įrašyta sėkmingai";
										}
									}
									echo $klaida;
								}
							?>
						</form>
						<?php }} else { ?>
					<form class="form-horizontal" method="POST">
					  <div class="form-group">
						<label for="varas" class="col-sm-2 control-label">Slapyvardis</label>
						<div class="col-sm-10">
						  <input type="text" name="name" class="form-control" placeholder="Admin slapyvardis">
						</div>
					  </div>
					  <div class="form-group">
						<label for="varas" class="col-sm-2 control-label">Slaptažodis</label>
						<div class="col-sm-10">
						  <input type="password" name="pass" class="form-control" placeholder="Admin slaptažodis">
						</div>
					  </div>
					  <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						  <input name="toliau" type="submit" class="btn btn-success" value="Tęsti">
						</div>
					  </div>
					</form>		
				<?php } ?>
				<?php 
					if(isset($_POST['toliau'])){
						$name = $_POST['name'];
						$pas = $_POST['pass'];
						$pass = hash('sha512', $pas);
						if($name == $aname && $pass == $apas){
							$_SESSION["admin"] = $_POST['name'];
							reload();
						} else {
							 $klaida = "Blogi duomenys...";
						}
						echo $klaida;
					}
				?>
				<?php if($_GET['atsijungti'] == 1){ session_destroy(); reload(); } else { echo""; } ?>
			</div>
		</div>
	</div>
</div>
	<div class="col-md-1"></div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$('.btn-info').popover();
		$(function () {
			$("[rel='tooltip']").tooltip();
		});
		$(document).ready(function (){
		  $("span").tooltip({
			'selector': '',
			'placement': 'top',
			'container':'body'
		  });
		});
	</script>
</body>
</html>