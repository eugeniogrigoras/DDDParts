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

<?php require 'navbar.php'; ?>

<!-- Inizio Register  -->
<div class="centered" style="margin-top:24px">
    <div class="vertical-section" style="padding:0;">
        <div class="title" style="padding:24px">Your Information</div>
        <div style="padding:24px; background-image:url('img/bg1.jpg'); background-size:cover">
            <div id="avatar" onclick="chooseImage()">
            	<?php
                    echo "<img id=\"preview\" src='".requestPath()."/profile.jpg'>";
                ?>
            </div>
        </div>
        <?php
            $data=requestData();
        ?>
        <form style="padding:12px 24px; padding-bottom:24px;" id="formPost" action="functions.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="<?php echo ini_get("session.upload_progress.name"); ?>" value="123" />
            <input type="hidden" value="changeInformation" name="getpage">
            <input value="<?php echo requestPath().'/profile.jpg'; ?>" accept=".jpg,.jpeg" type="file" name="fileToUpload" id="fileToUpload" style="display:none;visibility:hidden;">
            <paper-input required id="currentPassword" error-message="Insert password!" name="password" label="Current Password" type="password"></paper-input>
            <input type="text" name="currentPasswordInvisible" value="<?php echo $data["PASSWORD"]; ?>" id="currentPasswordInvisible" style="display:none">
            <paper-input disabled id="password" error-message="Insert password!" name="password" label="Password" type="password">
                <paper-icon-button style="color:#424242" id="passwordIcon" suffix onclick="showPassword();" icon="visibility" alt="visibility" title="visibility"></paper-icon-button>
            </paper-input>
            <paper-textarea value="<?php echo $data["DESCRIPTION"]; ?>" id="description" name="description" label="Description" type="text" char-counter maxlength="300" disabled></paper-textarea>
            <input type="text" name="descriptionhidden" value="<?php echo $data["DESCRIPTION"]; ?>" id="descriptionhidden" style="display:none">
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

    $("#currentPassword").change(function(){
        if (document.getElementById('currentPasswordInvisible').value==this.value) {
            $("#password").removeAttr("disabled");
            $("#repeat_password").removeAttr("disabled");
            $("#description").removeAttr("disabled");
        }
    	
    });

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

    function chooseImage() {
        document.getElementById('fileToUpload').click();
        console.log("Choosed!");
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