<?php
	session_start();

	if(isset($_SESSION["prijava"]) && !empty($_SESSION["prijava"])){
		header("Location: index.php"); /* Redirect browser */
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
		<div id="loginForm">
			Prijava
			<form action="LoginScript.php" method="post">
				<div class="spn">Uporabniško : <input id="usernm" type="text" name="username"><br></div>
				<div class="spn">Geslo : <input id="passwd" type="password" name="password"><br></div>
				<div class="spn"><input id="submt" type="submit"></div>
			</form>			

			<?php 
			if(isset($_GET["data"]) && $_GET["data"] == "invalid") {
				?> <div id="prijavaRedMsg">Nepravilen vnos podatkov!</div> <?php
			}else if(isset($_GET["login"]) && $_GET["login"] == "failed"){
				?> <div id="prijavaRedMsg">Prijava neuspešna!</div> <?php
			}else if(isset($_GET["reg"]) && $_GET["reg"] == "success"){
				?> <div id="prijavaGreenMsg">Registracija uspešna!</div> <?php
			}
			?>

			<a href="Registracija.php">Registracija</a>
			<a href="index.php">Ogled predmetov</a>
		</div>
	</div>
	
	<footer>
		2016 Univerza v Ljubljani, Fakulteta za računalništvo in informatiko, Aleš Horvat
	</footer>
</body>
</html>