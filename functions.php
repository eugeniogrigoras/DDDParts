<?php
	if(!isset($_SESSION["ID"])) {
        session_start();
    }

    $LASTINSERTEDID;

	if(isset($_POST['submit'])) {
   		if (isset($_REQUEST["getpage"])) {
   			switch ($_REQUEST["getpage"]) {
   				case 'changeInformation':
					$data=requestData();
					if ($data) {
						if (isset($_REQUEST["descriptionhidden"])) {
							if ($data["DESCRIPTION"]!=$_REQUEST["descriptionhidden"]) {
	   							changeDescription($_REQUEST["descriptionhidden"]);
	   						}
						}
						if (isset($_REQUEST["password"])) {
							if (($data["PASSWORD"]!=$_REQUEST["password"]) && (strlen($_REQUEST["password"])!=0)) {
	   							changePassword($_REQUEST["password"]);
	   						}
						}
					}
					header("location: account.php?updated=true");
					exit();
   					break;

   				case 'login':
   					$email = $_REQUEST['email'];
					$pass = $_REQUEST['password'];
   					if (!isset($email) || !isset($pass)) {
   						header("location: login.php?err=true");
   						exit();
   					} else {
						$ris=executeQuery("select * from utenti where utenti.EMAIL='$email' AND utenti.PASSWORD='$pass'");
						if ($ris && ($ris->num_rows > 0)) {
							$riga=$ris->fetch_assoc();
							$_SESSION["ID"]=$riga[ID];
							$_SESSION["NOME"]=$riga[NOME];
							$_SESSION["COGNOME"]=$riga[COGNOME];
							$_SESSION["EMAIL"]=$riga[EMAIL];
							header("location: index.php");
							exit();
						} else {
							header("location: login.php?err=true");
   							exit();
						}
   					}
   					exit();
   					break;

   				case 'register':
   					$name = $_REQUEST['name'];
				    $surname = $_REQUEST['surname'];
				    $email = $_REQUEST['email'];
				    $comune = $_REQUEST['comunehidden'];
				    $password = $_REQUEST['password'];
				    $repeat_password = $_REQUEST['repeat_password'];
				    $description = $_REQUEST['descriptionhidden'];
				    if ((!isset($name) || !isset($surname) || !isset($email) || !isset($comune) || !isset($password) || !isset($description)) || ($repeat_password!=$password) || (strlen($password)==0)) {
				    	header("location: register.php?err=true");
   						exit();
				    } else {
				    	$randomString=randomString(10);
				    	$QUERY=executeQuery("insert ignore into utenti  (NOME, COGNOME, EMAIL, DESCRIZIONE, PASSWORD, CODICE_CONFERMA, ACCETTATO, FK_COMUNE) VALUES ('$name', '$surname', '$email', '$description', '$password', '$randomString', 'FALSE', '$comune')");
				    	$last_id = $LASTINSERTEDID;
				    	if ($last_id==0) {
			                echo "Email già registrata!";
			            } else {
			            	$_SESSION["ID"]=$last_id;
							$_SESSION["NOME"]=$name;
							$_SESSION["COGNOME"]=$surname;
							$_SESSION["EMAIL"]=$email;

			            	echo "New record created successfully. Last inserted ID is: " . $last_id;
			            	if (!file_exists(requestPath())) {
			                    mkdir(requestPath(), 0777, true);
			                    copy('img/default.jpg', requestPath()."/profile.jpg"); 
			                }

			                localMail($email, $name, $surname, $randomString, $last_id);
			                //altervista($email, $randomString, $last_id);

			                controlloImmagine();
			                session_unset();
        					session_destroy();
			            }
				    }
				    //header("location: login.php");
				    //exit();
   					break;
   				default:
   					header("location: index.php");
   					exit();
   					break;
   			}
   		}
	}

	function controlSession() {
		if(!isset($_SESSION["ID"])) {
	   		return false;
	    } else {
	    	return true;
	    }
	}

	function requestPath() {
		if (controlSession()) {
			return "users/".$_SESSION["NOME"]."-".$_SESSION["COGNOME"]."-".$_SESSION["EMAIL"];
		} else {
			return false;
		}
	}

	function requestData() {
		if (controlSession()) {
			$data=executeQuery("select * from utenti where ID=".$_SESSION["ID"]);
			
			if ($data) {
				if ($data->num_rows > 0) {
		        	$riga=$data->fetch_assoc();
					$array = array(
			    		"ID" => $riga["ID"],
			    		"NAME" => $riga["NOME"],
			    		"SURNAME" => $riga["COGNOME"],
			    		"DESCRIPTION" => $riga["DESCRIZIONE"],
			    		"EMAIL" => $riga["EMAIL"],
			    		"PASSWORD" => $riga["PASSWORD"]
					);
					return $array;
				} else {
					return false;
				}
			} else {
				return false;
			}	
		} else {
			return false;
		}
	}

	function executeQuery($QUERY) {
		$conn= new mysqli("localhost","root","",'my_dddparts'); 

    	if ($conn->connect_error) {
        	die("Connection failed: " . $conn->connect_error);
        	mysqli_close($conn);
        	return false;
    	} else {
    		$ris=$conn->query($QUERY);
    		if ($ris) {
    			$LASTINSERTEDID=$conn->insert_id;
    			mysqli_close($conn);
    			return $ris;
    		} else {
    			echo "Error: " . "<br>" . $conn->error;
    			mysqli_close($conn);
    			return false;
    		}
    	}
	}
	function changeDescription($DESCRIPTION) {
		$QUERY=executeQuery("update utenti set DESCRIZIONE = '$DESCRIPTION' where ID=".$_SESSION["ID"]);
		if($QUERY) {
			return true;
		} else {
			echo "Vaffanculo";
			return false;
		}
	}
	function changePassword($PASSWORD) {
		$QUERY=executeQuery("update utenti set PASSWORD = '$PASSWORD' where ID=".$_SESSION["ID"]);
		if($QUERY) {
			return true;
		} else {
			return false;
		}
	}
	function changeName($NAME) {
		$QUERY=executeQuery("update utenti set NOME = '$NAME' where ID = ID=".$_SESSION["ID"]);
		if($QUERY) {
			return true;
		} else {
			return false;
		}
	}
	function changeSurname($SURNAME) {
		$QUERY=executeQuery("update utenti set COGNOME = '$SURNAME' where ID=".$_SESSION["ID"]);
		if($QUERY) {
			return true;
		} else {
			return false;
		}
	}

	function convertImage($originalImage, $outputImage, $quality)
	{
	    // jpg, png, gif or bmp?
	    $exploded = explode('.',$originalImage);
	    $ext = $exploded[count($exploded) - 1]; 

	    if (preg_match('/jpg|jpeg/i',$ext))
	        $imageTmp=imagecreatefromjpeg($originalImage);
	    else if (preg_match('/png/i',$ext))
	        $imageTmp=imagecreatefrompng($originalImage);
	    else if (preg_match('/gif/i',$ext))
	        $imageTmp=imagecreatefromgif($originalImage);
	    else if (preg_match('/bmp/i',$ext))
	        $imageTmp=imagecreatefrombmp($originalImage);
	    else
	        return false;

	    // quality is a value from 0 (worst) to 100 (best)
	    imagejpeg($imageTmp, $outputImage, $quality);
	    imagedestroy($imageTmp);

	    return $outputImage;
	}

	function randomString($length) {
    	return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	}

	function localMail($email, $name, $surname, $randomString, $last_id) {
		require 'PHPMailer/PHPMailerAutoload.php';
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
	}
	function altervistaMail($email, $randomString, $last_id) {
		$to  = $email;
        $subject = "Registrazione effettuata con successo!";
        $message = "Conferma il tuo account: http://dddparts.altervista.org/activate.php?codice=$randomString&id=$last_id";;
        $headers = 'From: DDDParts' . "\r\n" .
                   'Reply-To: info.dddparts@gmail.com' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();
        mail($to, $subject, $message, $headers);
	}

	function controlloImmagine() {
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
?>