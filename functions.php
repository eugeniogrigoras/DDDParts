<?php
	function executeQuery($QUERY) {
		$conn= new mysqli("localhost","root","",'my_dddparts'); 

    	if ($conn->connect_error) {
        	die("Connection failed: " . $conn->connect_error);
        	return false;
    	} else {
    		$ris=$conn->query($QUERY);
    		if ($ris===TRUE) {
    			return $ris;
    		} else {
    			return false;
    		}
    	}
	}
	function changeInformation ($PASSWORD, $DESCRIPTION) {
		if ($PASSWORD!=null) {
			$QUERY=executeQuery("update utenti set PASSWORD = $PASSWORD where ID = $_SESSION[\"ID\"]");
			if($QUERY==false) {
				return false;
			} else {
				return true;
			}
		}
		if ($DESCRIPTION!=null) {
			$QUERY=executeQuery("update utenti set DESCRIPTION = $DESCRIPTION where ID = $_SESSION[\"ID\"]");
			if($QUERY==false) {
				return false;
			} else {
				return true;
			}
		}
	}
?>