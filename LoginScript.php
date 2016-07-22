<?php
	session_start();
	require_once "DBInit.php";

	if(!empty($_POST["username"]) && !empty($_POST["password"])){
		$user = $_POST["username"];
		$pass = $_POST["password"];

		$db = DBInit::getInstance();

		if(substr($user, -12) == '@profesor.si'){
			$statement = $db->prepare("SELECT Count(*) AS cnt FROM profesor WHERE email=:user AND geslo=:passwd");
		}else{
			$statement = $db->prepare("SELECT Count(*) AS cnt FROM student WHERE email=:user AND geslo=:passwd");
		}
		
        $statement->bindParam(":user", $user);
        $statement->bindParam(":passwd", hash("md5",$pass));
        $statement->execute();

        $numRows = $statement->fetch();

        if($numRows["cnt"] == 0){
        	session_destroy();
			header("Location: Prijava.php?login=failed"); /* Redirect browser */
			exit();
        }else{
        	$_SESSION["prijava"] = $user;
        	$_SESSION["pravice"] = (substr($user, -12) == '@profesor.si') ? "profesor" : "student";
        	echo "success";
        	header("Location: index.php"); /* Redirect browser */
			exit();
        }
	}else{
		session_destroy();
		header("Location: Prijava.php?data=invalid"); /* Redirect browser */
		exit();
	}
?>