<?php require 'head.php';?>

<title>Account</title>

<style is="custom-style"></style>

<?php require 'navbar.php';?>

<!-- SOLO PER PROVARE IL SESISON_UNSET() --> 
<div class="centered" style="margin-top:24px">
    <div class="vertical-section" style="padding:0;">
        <div class="title" style="padding:24px">Account</div>
            <div class="submit-button-container">
                <button type="button" name="logout" onclick="logout()">Logout</button>
            </div>
        <hr style="margin:0;">
    </div>
</div>
<!-- ___________________________________ --> 

<?php require 'footer.php';?>

<script>
	function logout(){
		<?php 
			session_unset();
			header("location: index.php");	
		 ?>
	}
</script>

<?php require 'close.php';?>