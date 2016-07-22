<?php
	session_start();
	$_SESSION["prijava"] = null;
	session_destroy();

	header("Location: Prijava.php"); /* Redirect browser */
	exit();
?>