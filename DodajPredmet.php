<?php
	session_start();
	require_once "DBInit.php";

	if(!isset($_SESSION["prijava"]) || empty($_SESSION["prijava"]) || $_SESSION["pravice"] == "student"){
		header("Location: Prijava.php"); /* Redirect browser */
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Spletna učilnica</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
</head>

<body>
	<header>
		<h2>SPLETNA UČILNICA</h2>
	</header>

	<div id="content">
		<div id="mainPage">
			<div id="leftSide">
				<h3>MENI</h3>
				<div id="menuLinks">					
					<?php
						if(isset($_SESSION["prijava"]) && !empty($_SESSION["prijava"])){
							echo $_SESSION["prijava"] . "<br><br>";?>
							<a href="index.php">Vsi predmeti</a> <br><br>

							<a href="index.php?predmeti=moji">Moji predmeti</a> <br><br>
							<?php
							if($_SESSION["pravice"] == "profesor"){
								?><a href="DodajPredmet.php">Dodaj predmet</a> <br><br><?php
							}
							?>
							<a href="LogoutScript.php">Odjava</a> <br><br>
							<?php			
						}else{
							?>
							<a href="index.php">Vsi predmeti</a> <br><br>

							<a href="Prijava.php">Prijava</a> <br><br>

							<a href="Registracija.php">Registracija</a> <br><br>
							<?php
						}
					?>
				</div>
			</div>
			<div style="text-align: left;" id="middle">
				<?php
					$db = DBInit::getInstance();
					?> <h3>Dodaj predmet</h3> <?php

				?>
				<form id="dodajPredmet" action="dodajPredmetScript.php" method="POST">
					Naslov predmeta<br>
					<input type="text" name="naslov"><br><br>
					Opis<br>
					<textarea name="opis" form="dodajPredmet" cols="50" rows="5"></textarea><br>
					Termin<br>
					<input type="time" name="cas"><br><br>
					Dan<br>
					<input type="text" name="dan"><br><br>
					Prostor<br>
					<input type="text" name="prostor"><br><br>
					<input type="submit" value="Dodaj predmet">					
				</form>
				
				<?php
					if(!empty($_GET["input"])){
						if($_GET["input"] == "invalid"){
							?><div style="color : red;"><?php echo "<br><br> Nepravilen vnos!";?></div><?php
						}else if($_GET["input"] == "valid"){
							?><div style="color : green;"><?php echo "<br><br> Uspešno dodan predmet";?></div><?php
						}
					}
				?>
			</div>
		</div>
	</div>
	
	<footer>
		2016 Univerza v Ljubljani, Fakulteta za računalništvo in informatiko, Aleš Horvat
	</footer>
</body>
</html>