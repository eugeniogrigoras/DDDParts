<?php
	//recupero i dati
	$idregione=$_REQUEST['idregione'];
	//creo la connessione
	$conn= new mysqli("localhost","root","",'my_dddparts'); // questo è per xamp
	//$conn= new mysqli("localhost","nome dominio altervista","",'nome database'); questo è per altervista

	//scrivo la query per estrarre tutto il database
	$comando="select * from regioni, province where province.idregione=$idregione"; //dati_utenti è il nome della tabella

	//eseguo la query
	$record=$conn->query($comando);

	//scorro i dati per trovare una corrispondenza
	while ($riga=$record->fetch_assoc()) {
                                                
                                                echo "<paper-item onclick='provinceselect(this.id)' id='";
                                                echo "$riga[idprovincia]";
                                                echo "'>";
                                                echo "$riga[nomeprovincia]";
                                                echo "</paper-item>";
                                            }

	mysqli_close($conn);

?>