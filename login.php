<?php 
    error_reporting(0);
    session_start();
    if (isset($_REQUEST["fx"]) && $_REQUEST["fx"]=="logout" && isset($_REQUEST["value"]) && $_REQUEST["value"]=="true") {
        session_unset();
        session_destroy(); 
    }
?>

<?php require 'head.php';?>

<title>Login</title>

<style is="custom-style">

    paper-checkbox.grey {
        --paper-checkbox-checked-color: var(--paper-grey-800);
        --paper-checkbox-checked-ink-color: var(--paper-grey-800);
        --paper-checkbox-unchecked-color: var(--paper-grey-800);
        --paper-checkbox-unchecked-ink-color: var(--paper-grey-800);
        --paper-checkbox-label-color: var(--paper-grey-800);
    }

    .button-container {
        @apply(--layout-horizontal);
        @apply(--paper-font-caption);
        color:#757575;
    }

    .button-container paper-button {
        margin:1px 2px 2px 2px!important;
    }

    .submit-button-container paper-button {
        background-color: var(--paper-red-400);
        color:white;
        margin:0!important;
    }

    .submit-button-container {
        @apply(--layout-horizontal);
        @apply(--layout-end-justified);
    }

    .title {
        @apply(--paper-font-title);
        background-color: #424242;
        color:white;
    }

    paper-input-container {
        --paper-input-container-underline-focus: var(--paper-red-500);
    }

</style>

<?php require 'navbar.php';?>

<!-- Inizio Sign In  -->
<div class="centered" style="margin-top:24px">
    <div class="vertical-section" style="padding:0;">
        <?php 
            if (!isset($_REQUEST["fx"])) {
                echo "<div class=\"title\" style=\"padding:24px\">Login</div>";
            } else if ($_REQUEST["fx"]=="error") {
                echo "<div class=\"title\" style=\"padding:24px\">Login - ".$_REQUEST["value"]."</div>";
            }
        ?>
        <form style="padding:24px;" id="formPost" action="functions.php" method="post" enctype="multipart/form-data">
            <input type="hidden" value="login" name="getpage">
            <gold-email-input name="email" required auto-validate error-message="Please enter a valid email!" label="Email contact"></gold-email-input>
            <paper-input required id="password" error-message="Insert password!" name="password" label="Password" type="password">
                <paper-icon-button style="color:#424242" id="passwordIcon" suffix onclick="showPassword();" icon="visibility" alt="clear" title="clear"></paper-icon-button>
            </paper-input>
            <br>
            <paper-checkbox checked class="grey">Remember me</paper-checkbox>
            <br><br>
            <div class="submit-button-container">
                <paper-button id="paper-button" onclick="submitForm()">Login</paper-button>
                <button type="submit" id="SubmitButton" name="submit" style="display:none"></button>
            </div>
        </form>
        <hr style="margin:0;">
        <div class="button-container">
            <paper-button>LOST YOUR PASSWORD?</paper-button>
            <div class="flex"></div>
            <paper-button onclick="location.href = 'register.php'">REGISTER</paper-button>
        </div>
    </div>
</div>
<!-- Fine Sign In  -->

<?php require 'footer.php';?>

<script>
    function submitForm(){
        document.getElementById('SubmitButton').click();
        console.log("Login!");
    }
    function showPassword() {
        var password = document.getElementById("password");
        var passwordIcon = document.getElementById("passwordIcon");
        if (password.type=="password") {
            password.type="text";
            passwordIcon.icon="visibility-off";
        } else {
            password.type="password";
            passwordIcon.icon="visibility";
        }
    }
</script>

<?php require 'close.php';?>
