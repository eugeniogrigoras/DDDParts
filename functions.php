<?php
	session_start();
    if ($_SESSION==array()) {
    	if (curPageName()=='functions.php'){
	    	if((isset($_POST['submit'])) && (isset($_REQUEST["getpage"]))) {
	    		
	    	} else {
	    		if ((isset($_REQUEST["getpage"])) && ($_REQUEST["getpage"]=="activate")) {

	    		} else {
	    			header("location: login.php");
	    			exit();
	    		}
	    	}
	    } else {
	    	//TUTTE LE PAGINE RAGGIUNGIBILI DA NON SESSSATO
	    	if ((curPageName()=='login.php') || (curPageName()=='register.php') || (curPageName()=='index.php')){

	    	} else {
	    		header("location: login.php");
	    		exit();
	    	}
	    }
    } else {
    	//TUTTE LE PAGINE NON RAGGIUNGIBILI DA SESSSATO
    	if ((curPageName()=='login.php') || (curPageName()=='register.php')) {
			header("location: account.php");
			exit();
		}
    }

    if ((isset($_REQUEST["getpage"])) && ($_REQUEST["getpage"]=="activate")) {
    	$codice=$_REQUEST['codice'];
		$id=$_REQUEST['id'];
		if (!isset($codice) || !isset($id)) {
			header("location: login.php?err=noUser");
			exit();
		} else {
			$QUERY=executeQuery("select * from utenti where CODICE_CONFERMA='$codice' and ID=$id");
			if ($QUERY) {
				$QUERY=executeQuery("update utenti SET ACCETTATO = '1' WHERE ID = $id;");
				if ($QUERY) {
					header("location: login.php?confirmed=true");
					exit();
				}
			} else {
				header("location: login.php?err=noUserInDatabase");
				exit();
			}
		}
    }

	if(isset($_POST['submit'])) {
   		if (isset($_REQUEST["getpage"])) {
   			switch ($_REQUEST["getpage"]) {

   				case 'changeInformation':
   					imageUpload();
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
						header("location: account.php?updated=true");
						exit();
					}
					header("location: account.php?updated=false");
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
				    	$last_id = $_SESSION["LASTINSERTEDID"];
				    	if ($last_id==0) {
			                header("location: register.php?err=mailAlreadyExist");
			                exit();
			            } else {
			            	$_SESSION["ID"]=$last_id;
							$_SESSION["NOME"]=$name;
							$_SESSION["COGNOME"]=$surname;
							$_SESSION["EMAIL"]=$email;

			            	echo "New record created successfully. Last inserted ID is: " . $last_id;
			            	if (!file_exists(requestPath())) {
			                    mkdir(requestPath(), 0777, true);
			           			copy('img/default.jpg', requestPath()."/profile.jpg");
			                } else {
			                	if (!file_exists(requestPath()."/profile.jpg")) {
			                		copy('img/default.jpg', requestPath()."/profile.jpg");
			                	}
			                }

			                localMail($email, $name, $surname, $randomString, $last_id);
			                //altervista($email, $randomString, $last_id);

			                imageUpload();
			                session_unset();
        					session_destroy();
        					header("location: login.php");
				    		exit();
			            }
				    }
				    exit();
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

	function requestPathUser($NAME, $SURNAME, $EMAIL) {
		return "users/".$NAME."-".$SURNAME."-".$EMAIL;
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
    			if (isset($_REQUEST["getpage"]) && $_REQUEST["getpage"]=='register') {
    				$_SESSION["LASTINSERTEDID"]=$conn->insert_id;
    			}	
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
        $mail->Body    = "Conferma il tuo account: http://localhost/DDDParts/functions.php?getpage=activate&codice=$randomString&id=$last_id";

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
        $message = "Conferma il tuo account: http://dddparts.altervista.org/functions.php?getpage=activate&codice=$randomString&id=$last_id";;
        $headers = 'From: DDDParts' . "\r\n" .
                   'Reply-To: info.dddparts@gmail.com' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();
        mail($to, $subject, $message, $headers);
	}

	function convertImage($originalImage, $outputImage, $quality)
	{
	    if(imagejpeg(imagecreatefromstring(file_get_contents($originalImage)), $outputImage, $quality)) {
	    	return true;
	    } else {
	    	return false;
	    }
	    
	}

	function imageUpload() {
		if ($_FILES['fileToUpload']['size'] == 0 || $_FILES['fileToUpload']['error'] != 0) {
            echo "Error!";     
        } else { 
            // Qua diamo il nome all'immagine: NomeCognome + . + estensione; quindi dobbiamo solo dare il nome
            $_FILES['fileToUpload']['name']="profile.".pathinfo($_FILES['fileToUpload']['name'],PATHINFO_EXTENSION);
            $target_file = requestPath()."/profile.jpg";
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
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
            	if (convertImage($_FILES["fileToUpload"]["tmp_name"], $target_file, 100)) {
            		echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            	}
                else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
	}
	function curPageName() {
		return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
	}
	function getUtente($ID, $NAME, $SURNAME, $EMAIL, $FK_COMUNE, $CONT) {
		if ($CONT & 1 ) { 
			echo "<div class=\"utente-box col l6 m12 s12\" style=\"padding-right:0px; margin-bottom:24px\">";  
		} else {
		    echo "<div class=\"utente-box col l6 m12 s12\" style=\"padding-right:24px; margin-bottom:24px\">";
		} 
		
		echo "<div class=\"utente\">";
			echo"<div class=\"title\" style=\"padding:24px\">"
		            ."<iron-icon onclick=\"location.href ='login.php?logout=true'\" id=\"$ID\" icon=\"favorite-border\" style=\"margin-right:24px; cursor:pointer\"></iron-icon>"
		            .$NAME." "
		            .$SURNAME
				."</div>";
		
		echo "<div style=\"padding:24px; background-image:url('img/bg1.jpg'); background-size:cover\">"
            ."<div id=\"avatar\">";
                echo "<img id=\"preview\" src='".requestPathUser($NAME, $SURNAME, $EMAIL)."/profile.jpg'>";
        echo "</div></div>";

        echo "<div class=\"account\">"
	        	."<div class=\"sections row\" style=\"margin-bottom:0;\">"
		        	."<div class=\"card col s4\" id=\"projects\">"
			        	."<div class=\"number\">12</div>"
			        	."<div class=\"subtitle\">PROJECTS</div>"
			        	."<paper-ripple recenters></paper-ripple>"
		        	."</div>"
		        	."<div class=\"card col s4\" id=\"my-collection\">"
			        	."<div class=\"number\">27</div>"
			        	."<div class=\"subtitle\">COLLECTIONS</div>"
			        	."<paper-ripple recenters></paper-ripple>"
		        	."</div>"
		        	."<div class=\"card col s4\" id=\"city\">"
			        	."<div class=\"number\">REGGIO EMILIA</div>"
			        	."<div class=\"subtitle\">CITY</div>"
			        	."<paper-ripple recenters></paper-ripple>"
		        	."</div>"
		        ."</div>"
		    ."</div>";
		echo "</div>";
        echo "</div>";
	}	
?>