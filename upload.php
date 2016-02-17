<?php
    echo $_FILES['fileToUpload']['size'] ;
    echo "<br>";
    echo $_FILES['fileToUpload']['error'];
    echo "<br>";
    echo $_FILES['fileToUpload']['name'];
    echo "<br>";
    echo $_FILES['fileToUpload']['name'];
    echo "<br>";
    echo $_FILES['fileToUpload']['tmp_name'];
    echo "<br>";
    echo basename($_FILES["fileToUpload"]["name"]);
    echo "<br>";
    if ($_FILES['fileToUpload']['size'] == 0 || $_FILES['fileToUpload']['error'] != 0) {
        echo "Error!";
        // Prova creazione cartella la cartella va creata in tutti i casi, l'ho messa qui nell'errore solo per prova
        if (!file_exists('users/3-Nome-Cognome')) {
            mkdir('users/3-Nome-Cognome', 0777, true);
        } else {
            // Prova copiatura immagine di default nella cartella se nel input:file non è stato inserito niente, quindi c'è stato un errore
            copy('img/default.jpg', 'users/3-Nome-Cognome/default.jpg');
        }
    } else { 
        // Qua diamo il nome all'immagine: NomeCognome + . + estensione; quindi dobbiamo solo dare il nome
        $_FILES['fileToUpload']['name']=$_REQUEST['name'].$_REQUEST['surname'].".".pathinfo($_FILES['fileToUpload']['name'],PATHINFO_EXTENSION);
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "jpeg") {
            echo "Sorry, only JPG & JPEG files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
?>