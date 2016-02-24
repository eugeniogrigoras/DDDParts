<?php require 'head.php';?>

<title>Change Information</title>

<style is="custom-style">
    paper-button {
        background-color: var(--paper-red-400);
        color:white;
        margin:0!important;
        width:100%;
    }
    .title {
        @apply(--paper-font-title);
        background-color: #424242;
        color:white;
    }
    paper-input-container {
        --paper-input-container-underline-focus: var(--paper-red-500);
    }
    paper-item:focus:before {
        @apply(--layout-fit);
        background: none;
        content: '';
        pointer-events: none;
    }
    paper-item:hover:before {
        @apply(--layout-fit);
        background: currentColor;
        content: '';
        opacity: var(--dark-divider-opacity);
        pointer-events: none;
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
        cursor: pointer;
        margin:auto auto;
        @apply(--shadow-elevation-4dp);
    }

    paper-checkbox.grey {
        @apply(--paper-font-caption);
        --paper-checkbox-checked-color: var(--paper-grey-800);
        --paper-checkbox-checked-ink-color: var(--paper-grey-800);
        --paper-checkbox-unchecked-color: var(--light-primary-color);
        --paper-checkbox-unchecked-ink-color: var(--light-primary-color);
        --paper-checkbox-label-color: var(--paper-grey-800);
    }

    paper-checkbox.error {
        --paper-checkbox-label-color: var(--light-accent-color);
    }
</style>

<?php require 'navbar.php'; require 'requestData.php';?>

<!-- Inizio Register  -->
<div class="centered" style="margin-top:24px">
    <div class="vertical-section" style="padding:0;">
        <div class="title" style="padding:24px">Your Information</div>
        <div style="padding:24px; background-image:url('img/bg1.jpg'); background-size:cover">
            <div id="avatar" onclick="chooseImage()">
            	<?php
                    $percorso=$_SESSION["NOME"]."-".$_SESSION["COGNOME"]."-".$_SESSION["EMAIL"];
                    echo "<img id=\"preview\" src='users/".$percorso."/profile.jpg'>";
                ?>
            </div>
        </div>
        <form style="padding:12px 24px; padding-bottom:24px;" id="formPost" action="upload.php" method="post" enctype="multipart/form-data">
            <input value="img/default.jpg" accept=".jpg,.jpeg" type="file" name="fileToUpload" id="fileToUpload" style="display:none;visibility:hidden;">
            <paper-input required id="currentPassword" error-message="Insert password!" name="password" label="Current Password" type="password"></paper-input>
            <paper-input required id="password" error-message="Insert password!" name="password" label="New Password" type="password" disabled></paper-input>
            <paper-input required id="repeat_password" error-message="Password is not the same!" name="repeat_password" label="Repeat New Password" type="password" disabled></paper-input>
            <paper-textarea value="<?php echo $DESCRIPTION; ?>" id="description" name="description" label="Description" type="text" char-counter maxlength="300" disabled></paper-textarea>
            <input type="text" name="descriptionhidden" value="" id="descriptionhidden" style="display:none">
            <br><br>
            <paper-button id="paper-button" onclick="submitForm()">Update Information</paper-button>
            <button type="submit" id="SubmitButton" name="submit" style="display:none"></button>
            
        </form>
    </div>
</div>
<!-- Fine Register  -->

<?php require 'footer.php';?>

<script>

    passwordField=document.getElementById('password');
    repeatPasswordField=document.getElementById('repeat_password');

    $( "#description" ).change(function() {
        document.getElementById('descriptionhidden').value=this.value;
    });

    $( "#password" ).change(function() {
        controlloPassword();
    });

    $( "#repeat_password" ).change(function() {
        controlloPassword();
    });

    $("#currentPassword").change(function(){
    	alert("ciao");
        var cpass="<?php echo $PASSWORD;?>";
        alert (cpass);
    });

    function chooseImage() {
        document.getElementById('fileToUpload').click();
        console.log("Choosed!");
    }

    function controlloPassword() {
        if ((passwordField.value.length==0) && (repeatPasswordField.value.length==0)) {
            passwordField.invalid=true;
            repeatPasswordField.invalid=false;
            return false;
        }
        if ((passwordField.value.length!=0) && (repeatPasswordField.value.length==0)) {
            passwordField.invalid=false;
            repeatPasswordField.invalid=true;
            return false;
        }
        if ((passwordField.value.length==0) && (repeatPasswordField.value.length!=0)) {
            passwordField.invalid=true;
            repeatPasswordField.invalid=true;
            return false;
        }
        if ((passwordField.value.length!=0) && (repeatPasswordField.value.length!=0)) {
            if (passwordField.value==repeatPasswordField.value) {
                passwordField.invalid=false;
                repeatPasswordField.invalid=false;
                return true;
            } else {
                passwordField.invalid=false;
                repeatPasswordField.invalid=true;
                return false
            } 
        }
    }

    function submitForm(){
        document.getElementById('SubmitButton').click();
        console.log("Changed!"); 
     }

    $("#fileToUpload").change(function(){
        readURL(this);
    });

    $("#privacy").change(function(){
        privacyControl=this.checked;
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
                $('#avatar').attr('style', "background-image:url("+e.target.result+")");
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<?php require 'close.php';?>