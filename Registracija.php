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
		<div id="registrationForm">
			Registracija
			<form action="RegistrationScript.php" method="post">
				<div class="spn">Student <input class="rightFloat" checked="true" type="radio" name="pravice" value="student"><br></div>
  				<div class="spn">Profesor <input class="rightFloat" type="radio" name="pravice" value="profesor"><br></div>
				<div class="spn">Ime : <input class="rightFloat" type="text" name="name"><br></div>
				<div class="spn">Priimek : <input class="rightFloat" type="text" name="surname"><br></div>
				<div class="spn">Uporabniško : <input class="rightFloat" type="text" name="username"><br></div>
				<div class="spn">Geslo : <input class="rightFloat" type="password" name="password"><br></div>
				<div class="spn">Datum rojstva : <input class="rightFloat" type="date" name="bday" min="1950-1-1" max="2010-1-1"><br></div>
				<div class="spn">Naziv (profesor) : <input class="rightFloat" type="text" name="naziv"><br></div>
				<div class="spn">Letnik (student) : <input class="rightFloat" type="number" name="letnik"><br></div>
				<div class="spn"><input id="submt" type="submit"></div>
			</form>
			
			<div id="regError">
			<?php 
			if(isset($_GET["input"]) && $_GET["input"] == "invalid") {
				echo "Nepravilen vnos podatkov!";
			}else if(isset($_GET["user"]) && $_GET["user"] == "exists"){
				echo "Uporabniško ime zasedeno";
			}
			?>
			</div>

			<a href="Prijava.php">Prijava</a>
			<a href="index.php">Ogled predmetov</a>
		</div>
	</div>
	
	<footer>
		2016 Univerza v Ljubljani, Fakulteta za računalništvo in informatiko, Aleš Horvat
	</footer>
</body>
</html>