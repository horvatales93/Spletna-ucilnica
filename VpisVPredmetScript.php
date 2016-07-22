<?php
	session_start();
	require_once "DBInit.php";

	if(!isset($_SESSION["prijava"]) || empty($_SESSION["prijava"]) || $_SESSION["pravice"] == "profesor"){
		header("Location: Prijava.php"); /* Redirect browser */
		exit();
	}

	$user = $_SESSION["prijava"];

	$db = DBInit::getInstance();
	$statement = $db->prepare("SELECT idStudent as id FROM student WHERE email = :user");
	$statement->bindParam(":user", $user);			
	$statement->execute();				
	$result = $statement->fetch();

	$idStudenta = $result["id"];
	$idPredmeta = $_POST["idPredmet"];

	$statement2 = $db->prepare("INSERT INTO opravljanjepredmeta (idPredmet, idStudent, Ocena) VALUES (:idPredmeta, :idStudenta, 0)");
	$statement2->bindParam(":idPredmeta", $idPredmeta);
	$statement2->bindParam(":idStudenta", $idStudenta);				
	$statement2->execute();				

	header("Location: Podrobnosti_predmeta.php?id=" . $idPredmeta); /* Redirect browser */
	exit();
?>