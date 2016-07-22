<?php
	session_start();
	require_once "DBInit.php";

	if(!isset($_SESSION["prijava"]) || empty($_SESSION["prijava"]) || $_SESSION["pravice"] == "student"){
		header("Location: Prijava.php"); /* Redirect browser */
		exit();
	}

	if(empty($_POST["opis"]) || empty($_POST["naslov"]) || empty($_POST["cas"]) || empty($_POST["dan"]) || empty($_POST["prostor"])){
		header("Location: DodajPredmet.php?input=invalid"); /* Redirect browser */
		exit();
	}

	$user = $_SESSION["prijava"];

	$db = DBInit::getInstance();
	$statement = $db->prepare("SELECT idProfesor as id FROM profesor WHERE email = :user");
	$statement->bindParam(":user", $user);			
	$statement->execute();				
	$result = $statement->fetch();

	$idProfesor = $result["id"];
	$opis = $_POST["opis"];
	$naslov = $_POST["naslov"];
	
	$termin = $_POST["cas"];
	$dan = $_POST["dan"];
	$prostor = $_POST["prostor"];

	$statement2 = $db->prepare("INSERT INTO predmet (idProfesor, Opis, Naslov) VALUES (:idProfesor,:opis,:naslov)");
	$statement2->bindParam(":idProfesor", $idProfesor);
	$statement2->bindParam(":opis", $opis);
	$statement2->bindParam(":naslov", $naslov);
	$statement2->execute();

	$idPredmetStmt = $db->prepare("SELECT idPredmet FROM predmet WHERE Naslov = :naslov");
	$idPredmetStmt->bindParam(":naslov", $naslov);
	$idPredmetStmt->execute();
	$idPredmetResult = $idPredmetStmt->fetch();
	$idPredmet = $idPredmetResult["idPredmet"];

	$statement3 = $db->prepare("INSERT INTO termin (idPredmet, cas, dan, prostor) VALUES (:idPredmet, :cas, :dan, :prostor)");
	$statement3->bindParam(":idPredmet", $idPredmet);
	$statement3->bindParam(":cas", $termin);
	$statement3->bindParam(":dan", $dan);
	$statement3->bindParam(":prostor", $prostor);
	$statement3->execute();

	header("Location: DodajPredmet.php?input=valid"); /* Redirect browser */
	exit();
?>