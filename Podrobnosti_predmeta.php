<?php
	session_start();
	require_once "DBInit.php";
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
				$statement = $db->prepare("SELECT p.Naslov as naslov, p.Opis as opis, pr.Ime as ime, pr.Priimek as priimek, pr.email as email, pr.naziv as naziv FROM predmet p INNER JOIN profesor pr ON p.idProfesor = pr.idProfesor WHERE idPredmet = :id");
				$statement->bindParam(":id", $_GET["id"]);				
				$statement->execute();				
				$result = $statement->fetch();

				$statement2 = $db->prepare("SELECT cas as cas, dan as dan, prostor as prostor FROM termin WHERE idPredmet = :id");
				$statement2->bindParam(":id", $_GET["id"]);
				$statement2->execute();
				$result2 = $statement2->fetchAll();

				?>
				<h3><?php echo $result["naslov"] ?></h3>

				Nosilec : <?php echo $result["naziv"] . " " . $result["ime"] . " " . $result["priimek"] ?><br><br>

				Kontakt : <?php echo $result["email"] ?> <br><br>

				<div class="podrobnostiOpis">
					<?php echo $result["opis"] ?>
				</div>

				<br><br>Termini : <br>
				<ul>
				<?php
				foreach($result2 as $row){
					echo "<li>" . $row["dan"] . ", " . $row["cas"] . " , Prostor : " . $row["prostor"] . "</li>";
				}
				?>
				</ul>
				
				<?php
					if(isset($_SESSION["prijava"]) && !empty($_SESSION["prijava"])){
						if($_SESSION["pravice"] == "student"){
							$statement = $db->prepare("SELECT Count(*) as cnt, SUM(Ocena) as sumOcen FROM opravljanjepredmeta WHERE idPredmet = :idPredmet AND idStudent = (SELECT idStudent FROM student WHERE email = :user)");
							$statement->bindParam(":idPredmet", $_GET["id"]);	
							$statement->bindParam(":user", $_SESSION["prijava"]);			
							$statement->execute();				
							$result = $statement->fetch();
							if($result["cnt"] == 0){
								?> 
								<form action="VpisVPredmetScript.php" method="POST"> 
									<input type="hidden" name="idPredmet" value=<?php echo '"' . $_GET["id"] . '"'?>>
									<input class="btnVpis" value="Vpis v predmet" type="submit">
								</form>
								<?php
							}else{
								echo ($result["cnt"] > 1) ? ("Povprečna ocena : " . $result["sumOcen"]/($result["cnt"]-1)) : "Brez ocen";
							}
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