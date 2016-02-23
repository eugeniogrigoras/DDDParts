<?php require 'head.php';?>

<title>Account</title>

<style is="custom-style">
    .title {
        @apply(--paper-font-title);
        background-color: #424242;
        color:white;
    }
    #avatar img {
        width: 100%;
        height: 100%;
    }
    #avatar {
        overflow: hidden;
        border-radius: 50%;
        border: 3.5px solid rgba(255, 255, 255, 0.35);
        width: 150px;
        height: 150px;
        background-size: cover; 
        z-index: 2;
        text-align: center;
        margin:auto auto;
        @apply(--shadow-elevation-4dp);
    }
    div.account {
        padding: 24px;
    }
    div.sections {
        @aplly(--layout-horizontal);
    }
    paper-button {
        @aplly(--layout);
        @aplly(--layout-flex-auto);
    }
</style>

<?php require 'navbar.php';?>

<div class="centered" style="margin-top:24px; max-width: 100%;">
    <div class="vertical-section" style="padding:0;">
        <?php 
            if (isset($_SESSION["ID"])) {
                echo "<div class=\"title\" style=\"padding:24px\">".$_SESSION["NOME"]." ".$_SESSION["COGNOME"]."</div>";
            } else {
                echo "<div class=\"title\" style=\"padding:24px\">Login - Error</div>";
            }
        ?>
        <div style="padding:24px; background-image:url('img/bg1.jpg'); background-size:cover">
            <div id="avatar">
                <img id="preview" src="img/default.jpg" >
            </div>
        </div>
        <div class="account">
            <div class="sections">
                <paper-button id="paper-button" class="flex" onclick="submitForm()">Submit</paper-button>
                <paper-button id="paper-button" class="flex-2" onclick="submitForm()">Submit</paper-button>
                <paper-button id="paper-button" class="flex-2" onclick="submitForm()">Submit</paper-button>
                <paper-button id="paper-button" class="flex-2" onclick="submitForm()">Submit</paper-button>
                <paper-button id="paper-button" class="flex-2" onclick="submitForm()">Submit</paper-button>
                <paper-button id="paper-button" class="flex-2" onclick="submitForm()">Submit</paper-button>
                <paper-button id="paper-button" class="flex-2" onclick="submitForm()">Submit</paper-button>
            </div>
            <div class="submit-button-container">
                <button type="button" name="logout" onclick="logout()">Logout</button>
                <p>
                <?php
                    print_r($_SESSION);
                ?></p>
            </div>
        </div>
    </div>
</div>

<!-- ___________________________________ --> 

<?php require 'footer.php';?>

<script>
	function logout(){
        location.href = 'login.php?logout=true';
	}
</script>

<?php require 'close.php';?>