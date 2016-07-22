<?php
	require_once "DBInit.php";

	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		if(!empty($_POST["name"]) && !empty($_POST["surname"]) && !empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["bday"])){
			$name = $_POST["name"];
			$surname = $_POST["surname"];
			$username = $_POST["username"];
			$password = $_POST["password"];
			$bday = $_POST["bday"];
			if($_POST["pravice"] == "student"){
				if(!empty($_POST["letnik"])){
					$letnik = $_POST["letnik"];

					$db = DBInit::getInstance();

					$statement = $db->prepare("SELECT Count(*) AS cnt FROM student WHERE email=:user");
        			$statement->bindParam(":user", $username);
        			$statement->execute();

        			$numRows = $statement->fetch();

        			//če uporabniško ime obstaja vrni napako, sicer vnesi v bazo
        			if($numRows["cnt"] == 0){
        				$statement = $db->prepare("INSERT INTO student (ime, priimek, datumRojstva, letnik, geslo, email) VALUES (:ime, :priimek, :drojstva, :letnik, :geslo, :uporabnisko)");
        				$statement->bindParam(":ime", $name);
        				$statement->bindParam(":priimek", $surname);
        				$statement->bindParam(":drojstva", $bday);
        				$statement->bindParam(":letnik", $letnik);
        				$statement->bindParam(":geslo", hash("md5",$password));
        				$statement->bindParam(":uporabnisko", $username);
        				$statement->execute();

        				header("Location: Prijava.php?reg=success");
        				exit();
        			}else{
        				header("Location: Registracija.php?user=exists"); /* Redirect browser */
						exit();
        			}
				}
			}else if($_POST["pravice"] == "profesor"){
				if(!empty($_POST["naziv"])){
					$naziv = $_POST["naziv"];

					$db = DBInit::getInstance();

					$statement = $db->prepare("SELECT Count(*) AS cnt FROM profesor WHERE email=:user");
        			$statement->bindParam(":user", $username);
        			$statement->execute();

        			$numRows = $statement->fetch();

        			//če uporabniško ime obstaja vrni napako, sicer vnesi v bazo
        			if($numRows["cnt"] == 0){
        				$statement = $db->prepare("INSERT INTO profesor (ime, priimek, datumRojstva, naziv, geslo, email) VALUES (:ime, :priimek, :drojstva, :naziv, :geslo, :uporabnisko)");
        				$statement->bindParam(":ime", $name);
        				$statement->bindParam(":priimek", $surname);
        				$statement->bindParam(":drojstva", $bday);
        				$statement->bindParam(":naziv", $naziv);
        				$statement->bindParam(":geslo", hash("md5",$password));
        				$statement->bindParam(":uporabnisko", $username);
        				$statement->execute();

        				header("Location: Prijava.php?reg=success");
        				exit();
        			}else{
        				header("Location: Registracija.php?user=exists"); /* Redirect browser */
						exit();
        			}
				}
			}
		}
	}
	header("Location: Registracija.php?input=invalid"); /* Redirect browser */
	exit();

?>