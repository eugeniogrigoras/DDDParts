<?php 
	session_start();
	$email = $_REQUEST['email'];
	$pass = $_REQUEST['password'];

	$conn= new mysqli("localhost","root","",'my_dddparts');
	//$conn= new mysqli("localhost","nome dominio altervista","",'nome database');

	$comando="select * from utenti where utenti.EMAIL='$email' AND utenti.PASSWORD='$pass';";

	$ris=$conn->query($comando);
	if ($ris->num_rows > 0) {
		$riga=$ris->fetch_assoc();
		$_SESSION["ID"]=$riga[ID]; //setto l'ID dell'utente da tenere in memoria per le altre pagine
		$_SESSION["NOME"]=$riga[NOME];
		$_SESSION["COGNOME"]=$riga[COGNOME];
		$_SESSION["EMAIL"]=$riga[EMAIL];
		header("location: index.php");
	} else {
		header("location: login.php?err=utente o password errati");
	}

	mysql_close($conn);   
 ?>