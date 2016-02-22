<?php
    //recupero i dati
    $codice=$_REQUEST['codice'];
    $id=$_REQUEST['id'];
    //creo la connessione
    $conn= new mysqli("localhost","root","",'my_dddparts'); // questo è per xamp
    //$conn= new mysqli("localhost","nome dominio altervista","",'nome database'); questo è per altervista

    //scrivo la query per estrarre tutto il database
    $comando="select * from utenti where CODICE_CONFERMA=$codice and ID=$id"; //dati_utenti è il nome della tabella



    //eseguo la query
    $conn->query($comando);

    $comando="update utenti SET ACCETTATO = '1' WHERE ID = $id;";

    $conn->query($comando);

    echo "Confermato!";
    //scorro i dati per trovare una corrispondenza
   // while ($riga=$record->fetch_assoc()) {
   //     echo "$riga[COGNOME] "."$riga[NOME]<br>";
   // }

    mysqli_close($conn);
?>