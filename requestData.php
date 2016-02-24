<?php
	$ID;
	$NAME;
	$SURNAME;
	$DESCRIPTION;
	$EMAIL;
	if (isset($_SESSION["ID"])) {

		$conn= new mysqli("localhost","root","",'my_dddparts'); 

	    if ($conn->connect_error) {
	        die("Connection failed: " . $conn->connect_error);
	    } else {
	        $comando="select * from utenti where ID=".$_SESSION["ID"];
	        $record=$conn->query($comando);
	        if ($record) {
	        	while ($riga=$record->fetch_assoc()) {
					$ID = $riga["ID"];
					$NAME = $riga["NOME"];
					$SURNAME = $riga["COGNOME"];
					$DESCRIPTION = $riga["DESCRIZIONE"];
					$EMAIL = $riga["EMAIL"];
				}
	        } else {
	            echo "Error: " . $comando . "<br>" . $conn->error;
	        }
	    }

	    mysqli_close($conn);
	}
?>