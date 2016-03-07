<?php require 'head.php';?>

<title>Register</title>

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

<?php require 'navbar.php';?>

<!-- Inizio Register  -->
<div class="centered" style="margin-top:24px">
    <div class="vertical-section" style="padding:0;">
        <div class="title" style="padding:24px">About You</div>
        <div style="padding:24px; background-image:url('img/bg1.jpg'); background-size:cover">
            <div id="avatar" onclick="chooseImage()">
                <img id="preview" src="img/default.jpg" >
            </div>
        </div>
        <form style="padding:12px 24px; padding-bottom:24px;" id="formPost" action="functions.php" method="post" enctype="multipart/form-data">
            <input type="hidden" value="register" name="getpage">
            <input value="img/default.jpg" accept=".jpg,.jpeg" type="file" name="fileToUpload" id="fileToUpload" style="display:none;visibility:hidden;">
            <paper-input required name="name" label="Name" type="text"  auto-validate pattern="[a-zA-Z]*" error-message="Letters only!"></paper-input>
            <paper-input required name="surname" label="Surname" type="text"  auto-validate pattern="[a-zA-Z]*" error-message="Letters only!"></paper-input>
            <gold-email-input name="email" required auto-validate error-message="Please enter a valid email!" label="Email contact"></gold-email-input>
            <paper-dropdown-menu id="region" error-message="Select one!" label="Region" style="width: 100%;" required>
                <paper-listbox class="dropdown-content" style="width:200px!important">
                    <?php
                        $record = executeQuery("select * from regioni order by regioni.nomeregione");

                        while ($riga=$record->fetch_assoc()) {
                            echo "<paper-item onclick='regionselect(this.id)' id='";
                            echo "$riga[idregione]";
                            echo "'>";
                            echo "$riga[nomeregione]";
                            echo "</paper-item>";
                        }
                    ?>
                </paper-listbox>
            </paper-dropdown-menu>
            <div id="provinceDiv"></div>
            <div id="comuneDiv"></div>
            <input type="hidden" name="comunehidden" value="" id="comunehidden">
            <paper-input required id="password" error-message="Insert password!" name="password" label="Password" type="password">
                <paper-icon-button style="color:#424242" id="passwordIcon" suffix onclick="showPassword();" icon="visibility" alt="clear" title="clear"></paper-icon-button>
            </paper-input>
            <paper-textarea id="description" name="description" label="Description" type="text" char-counter maxlength="300"></paper-textarea>
            <input type="hidden" name="descriptionhidden" value="" id="descriptionhidden">
            <br><br>
            <paper-checkbox id="privacy" class="grey">I have read and agreed to the Terms of use</paper-checkbox>
            <br><br><br>
            <paper-button id="paper-button" onclick="submitForm()">Submit</paper-button>
            <button type="submit" id="SubmitButton" name="submit" style="display:none"></button>
            
        </form>
    </div>
</div>
<!-- Fine Register  -->

<?php require 'footer.php';?>

<script>
    var regionControl = false;
    var cityControl = false;
    var privacyControl = false;

    $( "#description" ).change(function() {
        document.getElementById('descriptionhidden').value=this.value;
    });

    function selezionecomune(str) {
        cityControl=true;
        document.getElementById('city').invalid=false;
        document.getElementById('comunehidden').value=str; 
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

    function regionselect(str) {
        provinceControl=false;
        cityControl=false;
        regionControl=true;
        document.getElementById('region').invalid=false;
        document.getElementById("comuneDiv").innerHTML = "";
        var xhttp;
        if (str.length == 0) { 
            document.getElementById("provinceDiv").innerHTML = "";
            return;
        }
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById("provinceDiv").innerHTML = xhttp.responseText;
            }
        };
        xhttp.open("GET", "getprovince.php?idregione="+str, true);
        xhttp.send();   
    }
    function provinceselect(str) {
        provinceControl=true;
        document.getElementById('province').invalid=false;
        var xhttp;
        if (str.length == 0) { 
            document.getElementById("comuneDiv").innerHTML = "";
            return;
        }
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById("comuneDiv").innerHTML = xhttp.responseText;
            }
        };
        xhttp.open("GET", "getcomune.php?idprovincia="+str, true);
        xhttp.send();   
    }

    function chooseImage() {
        document.getElementById('fileToUpload').click();
        console.log("Choosed!");
    }

    function submitForm(){
        if (!regionControl) {
            document.getElementById('region').invalid=true;
        } else {
            if (!provinceControl) {
                document.getElementById('province').invalid=true;
            } else {
                if (!cityControl) {
                    document.getElementById('city').invalid=true;
                } else {
                    if (privacyControl) {
                        document.getElementById('SubmitButton').click();
                        console.log("Submitted!"); 
                    }
                }
            }
        }
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