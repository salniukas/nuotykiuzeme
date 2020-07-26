<?php session_start();
require_once("duombaze/connect.php");
require_once("funkcijos.php");
include("duombaze/kintamieji.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/stilius.css" rel="stylesheet">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<style>
		.right{
			float: right;
		}
	</style>
  </head>
<body style="background: url('img/bg.jpg') no-repeat fixed 50% 0 rgb(20,20,20);">
    <br>
    <br>
<div class="container">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<?php if(isset($_SESSION["vardas"]) && $_SESSION["vardas"]){ $nick = $_SESSION['vardas']; ?>
			<div class="well">
				<div class="row">
					<div class="col-md-7">
						<div class="panel-body">
							<ul>
								<span class='glyphicon glyphicon-triangle-right'></span>Jei paslauga neužsidėjo, kreipkitės į skype: <b><?php echo $skype; ?></b></li>
								<p><span class='glyphicon glyphicon-triangle-right'></span>!Prieš išsiunčiant žinutė, pažiurėkite ar gerai parašėte tekstą!</li>
							</ul>
						</div>
					</div>
					<div class="col-md-5">
					<center>
							<div class="row">
								<div class="well">
									<p align="right">
										<img src="avatar.php?u=<?php echo $nick; ?>&s=40" data-toggle="tooltip" title="<?php echo $nick; ?>">
										<a href="index.php?atsijungti=1" class="btn btn-danger"><span class="glyphicon glyphicon-log-out"></span>Atsijungti <? echo $nick; ?></a>
										<?Php
											if($nick == $nickname){
												$smscon1 = $con->QUERY("SELECT * FROM sms WHERE username = '$nick'");
												$smsrows1 = $smscon1->fetch_All(MYSQLI_ASSOC);
												foreach ($smsrows1 as $smsrow1):
													$kadabaigias = $smsrow1['kadabaigsis'];
													$nickname = $smsrow1['username'];
													$paslauga = $smsrow1['paslauga'];
													$busena = $smsrow1['busena'];
												endforeach;
												echo "<br><span class='glyphicon glyphicon-triangle-right'></span><span class='text-success'>Šiuo momentu turite užsisake paslauga $paslauga<br>Paslauga galioja iki $kadabaigias</span>";
											} else {
												echo "<br><span class='glyphicon glyphicon-triangle-right'></span><span class='text-success'>Šiuo momentu užsisakę paslaugų neturite</span>";
											}
										?>
									</p>
								</div>
						</div>
						</center>
					</div>
				</div>
				<hr>
				<div class="row">
					<?Php 
						$paslaugos = "SELECT * FROM paslaugos";
						$isgaunam = $con->query($paslaugos);
						if ($isgaunam->num_rows > 0) {
							while($p = $isgaunam->fetch_assoc()) {
							if($p['laikas'] == ""){
								$laikas = "";
							} else {
								$laikas = "/ ".$p['laikas']." Dienų";
							}
							$nickassz = str_replace('[nick]', $nick, $p['galimybes']);
					?>
						<div class="col-lg-4 col-xs-4">
                            <div style="background-color:#3498db;height: 75px;">
                                <div style="padding: 3px;padding-left:15px;color: #fff;">
								<a data-toggle="modal" data-target="#<?php echo $p['cid'];?>" href="#<?php echo $p['cid'];?>" style="color:#fff;text-decoration:none;">
                                    <h4 style="font-family: Arial;">
                                        <? echo $p['pavadinimas']; ?>
                                    </h4>
                                    <p>
                                       <?php echo $p['kaina']; ?>€ <?php echo $laikas; ?>
                                    </p>
                                </a></div>
								<a data-toggle="modal" data-target="#<?php echo $p['cid'];?>" href="#<?php echo $p['cid'];?>" style="color:#fff;text-decoration:none;"></a>
								<div style="position: relative;margin-top: -15px;background-color: #2980b9;color: #fff;height: 30px;">
								<a data-toggle="modal" data-target="#<?php echo $p['cid'];?>" href="#<?php echo $p['cid'];?>" style="color:#fff;text-decoration:none;"></a>
								<h5><a data-toggle="modal" data-target="#<?php echo $p['cid'];?>" href="#<?php echo $p['cid'];?>" style="color:#fff;text-decoration:none;"></a>
								<a data-toggle="modal" data-target="#<?php echo $p['cid'];?>" href="#<?php echo $p['cid'];?>" style="color: #fff;float:right;padding-right: 15px;padding-top: 5px;"><b>Pirkti</b> <i class="glyphicon glyphicon-shopping-cart"></i></a></h5>
								</div>
							</div>
						</div>
						<div class="modal fade" id="<?php echo $p['cid'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel"><?php echo $p['pavadinimas'];?></h4>
							  </div>
							  <div class="modal-body">
								<table class="table table-striped table-bordered">
							<tbody>
								<tr><th>Tekstas</th><td><b>Numeris</b> </td><td><b>Kaina / Laikas</b> </td></tr>
								<tr><th><?php echo $p['raktazodis']." ".$nick; ?></th><td><?php echo $p['numeris']; ?></td><td><?php echo $p['kaina']."€ ".$laikas; ?></td></tr>
							</tbody>
						</table>
						Siųsk SMS žinutę su tekstu: <?php echo "<b>".$p['raktazodis']." ".$nick."</b>"; ?></b> </b> numeriu: <b><?php echo $p['numeris'];?></b><hr>
							<?php echo $p['pavadinimas']; ?> Privilegijos:
						<ul style="font-size:12px;list-style-type:disc">
							<?php echo $nickassz; ?>
						</ul>
						</div>
							  <div class="modal-footer">
								<center><?php echo "<div class='text-success'><i class='glyphicon glyphicon-ok'></i>".$p['subtekstas']."</div>"; ?></center>
							  </div>
							</div>
						  </div>
						</div>
						<?php }} ?>
			</div>				
			</div>
			<span class="badge alert-info right">CRIME.LT</span>			
					<?php } else {
			?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 style="font-family: Arial;color: #34495e;font-size: 18px;" class="panel-title text-center">MC.CRIME.LT Paslaugų užsakymas</h3>
					</div>
					<div class="panel-body text-center">
						<form method="POST">
							<input type="text" class="form-control" name="vardas" placeholder="Įveskite savo slapyvardi..."><br>
							<button type="submit" name="toliau" class="btn btn-info"><i class="fa fa-check"></i> Tęsti pirkimą</button>
						</form>
					<?php 
						if(isset($_POST['toliau']) && $name != "admin"){
							$name = $_POST['vardas'];
							if($name == ""){ $klaida = '<div class="label label-danger">Paliktas tusčias laukelis</div>'; } else {
								$_SESSION["vardas"] = $_POST['vardas'];
								reload();
							}
						}
						echo $klaida;
					?>								
					</div>
				</div>
				<span class="badge alert-info right">CRIME.LT</span>
			<?php 
			}
		
			if($_GET['atsijungti'] == 1){ session_destroy(); reload(); } else { echo""; }
			?>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>
	<script type="text/javascript">
		$('.btn-info').popover();
		$(function () {
			$("[rel='tooltip']").tooltip();
		});
		$(document).ready(function (){
		  $("img").tooltip({
			'selector': '',
			'placement': 'top',
			'container':'body'
		  });
		});
	</script>
  </body>
</html>