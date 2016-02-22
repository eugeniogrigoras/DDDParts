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
        <div class="title" style="padding:24px">Login</div>
        <form style="padding:24px;" is="iron-form" id="formPost" action="elogin.php" method="post" enctype="multipart/form-data">
            <gold-email-input name="email" required auto-validate error-message="Please enter a valid email!" label="Email contact"></gold-email-input>
            <paper-input name="password" label="Password" type="password" required></paper-input>
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
</script>

<?php require 'close.php';?>
