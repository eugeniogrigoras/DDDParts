<?php
    require 'PHPMailer/PHPMailerAutoload.php';

    $name = $_REQUEST['name'];
    $surname = $_REQUEST['surname'];
    $email = $_REQUEST['email'];
    $comune = $_REQUEST['comunehidden'];
    $password = $_REQUEST['password'];
    $repeat_password = $_REQUEST['repeat_password'];
    $description = $_REQUEST['descriptionhidden'];

    $length = 10;

    $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

    echo $randomString;

    $conn= new mysqli("localhost","root","",'my_dddparts'); 

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $nomeCartella = "users/$name-$surname-$email";
        $comando="insert ignore into utenti  (NOME, COGNOME, EMAIL, DESCRIZIONE, PASSWORD, PERCORSO, CODICE_CONFERMA, ACCETTATO, FK_COMUNE) VALUES ('$name', '$surname', '$email', '$description', '$password', '$nomeCartella', '$randomString', 'FALSE', '$comune')";

        if ($conn->query($comando) === TRUE) {
            $last_id = $conn->insert_id;

            if ($last_id==0) {
                echo "Email già registrata!";
            } else {
                echo "New record created successfully. Last inserted ID is: " . $last_id;

                if (!file_exists($nomeCartella)) {
                    mkdir($nomeCartella, 0777, true);
                    copy('img/default.jpg', $nomeCartella."/profile.jpg"); 
                }


                // LOCAL MAIL
                $mail = new PHPMailer;

                //$mail->SMTPDebug = 3;                               // Enable verbose debug output

                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'ssl://smtp.gmail.com;ssl://smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'info.dddparts@gmail.com';                 // SMTP username
                $mail->Password = '23dodici1996';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465;                                    // TCP port to connect to

                $mail->setFrom('info.dddparts@gmail.com', 'DDDParts');
                $mail->addAddress($email, $name." ".$surname);     // Add a recipient             // Name is optional

                $mail->Subject = 'Attivazione acount DDDParts!';
                $mail->Body    = "Conferma il tuo account: http://localhost/DDDParts/activate.php?codice=$randomString&id=$last_id";

                if(!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo 'Message has been sent';
                }
                //FINE

                // ALTERVISTA MAIL
                /*$to  = $email;
                $subject = "Registrazione effettuata con successo!";
                $message = "Conferma il tuo account: http://dddparts.altervista.org/activate.php?codice=$randomString&id=$last_id";;
                $headers = 'From: DDDParts' . "\r\n" .
                           'Reply-To: info.dddparts@gmail.com' . "\r\n" .
                           'X-Mailer: PHP/' . phpversion();
                mail($to, $subject, $message, $headers);*/
                //FINE

                
                // Controllo immagine

                if ($_FILES['fileToUpload']['size'] == 0 || $_FILES['fileToUpload']['error'] != 0) {
                    echo "Error!";     
                } else { 
                    // Qua diamo il nome all'immagine: NomeCognome + . + estensione; quindi dobbiamo solo dare il nome
                    $_FILES['fileToUpload']['name']="profile.".pathinfo($_FILES['fileToUpload']['name'],PATHINFO_EXTENSION);
                    $target_dir = $nomeCartella."/";
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
                    /*if (file_exists($target_file)) {
                        echo "Sorry, file already exists.";
                        $uploadOk = 0;
                    }*/
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
                            echo $target_file;
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }
                }
            }

        } else {
            echo "Error: " . $comando . "<br>" . $conn->error;
        }
    }

    mysqli_close($conn);

    echo $name;
    echo "<br>";
    echo $surname;
    echo "<br>";
    echo $email;
    echo "<br>";
    echo $comune;
    echo "<br>";
    echo $password;
    echo "<br>";
    echo $repeat_password;
    echo "<br>";
    echo $description;
    echo "<br>";
    
?>