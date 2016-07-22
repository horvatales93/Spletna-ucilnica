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
			<div id="middle">
				<?php
					$db = DBInit::getInstance();
					if(isset($_GET["predmeti"]) && $_GET["predmeti"] == "moji"){					
						?><h3>Moji predmeti</h3><?php
						if($_SESSION["pravice"] == "profesor"){
							$statement = $db->prepare("SELECT p.idPredmet as idpredmet, p.Opis as opis, p.Naslov as naslov, pr.ime as ime, pr.priimek as priimek FROM predmet p INNER JOIN profesor pr ON p.idProfesor = pr.idProfesor WHERE pr.email=:profesor");
							$statement->bindParam(":profesor", $_SESSION["prijava"]);
						}else{
							$statement = $db->prepare("SELECT p.idPredmet as idpredmet, p.Opis as opis, p.Naslov as naslov, pr.ime as ime, pr.priimek as priimek FROM predmet p INNER JOIN profesor pr ON p.idProfesor = pr.idProfesor WHERE p.idPredmet IN (SELECT o.idPredmet AS id FROM opravljanjepredmeta o INNER JOIN student s ON s.idStudent = o.idStudent WHERE s.email=:student)");//popravi
							$statement->bindParam(":student", $_SESSION["prijava"]);
						}
					}else{
						?><h3>Vsi predmeti</h3><?php
						$statement = $db->prepare("SELECT p.idPredmet as idpredmet, p.Naslov as naslov, p.Opis as opis, pr.Ime as ime, pr.Priimek as priimek FROM predmet p INNER JOIN profesor pr ON p.idProfesor = pr.idProfesor");
					}
					
        			$statement->execute();

        			$result = $statement->fetchAll();

        			foreach($result as $row){
        				?>
        				<div class="predmetPreview">
        					<b><a href=<?php echo "\"Podrobnosti_predmeta.php?id=" . $row["idpredmet"] . '">' . $row["naslov"]; ?></a></b><br><br>
        					<div class="predmetPreviewOpis">
        						<?php echo substr($row["opis"],0,120) . "..." ?>
        					</div>
        					<div class="predmetPreviewNosilec">
        						<?php echo "Nosilec : " . $row["ime"] . " " . $row["priimek"] ?>
        					</div>
        				</div>
        				<?php
        				
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