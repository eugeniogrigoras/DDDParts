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
    #avatar-container {
        background-color:#424242;
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
        <form  style="padding:12px 24px" is="iron-form" id="formPost" action="upload.php" method="post" enctype="multipart/form-data">
            <input value="img/default.jpg" accept=".jpg,.jpeg" type="file" name="fileToUpload" id="fileToUpload" style="display:none;visibility:hidden;">
            <paper-input required name="name" label="Name" type="text"  auto-validate pattern="[a-zA-Z]*" error-message="Letters only!"></paper-input>
            <paper-input required name="surname" label="Surname" type="text"  auto-validate pattern="[a-zA-Z]*" error-message="Letters only!"></paper-input>
            <gold-email-input name="email" required auto-validate error-message="Please enter a valid email!" label="Email contact"></gold-email-input>
            <paper-dropdown-menu label="Region" style="width: 100%;" required>
                <paper-listbox class="dropdown-content" style="width:200px!important">
                    <?php
                        $conn= new mysqli("localhost","root","",'my_dddparts'); 
                        
                        $comando="select * from regioni order by regioni.nomeregione";

                        $record=$conn->query($comando);
                       
                        while ($riga=$record->fetch_assoc()) {
                            echo "<paper-item onclick='regionselect(this.id)' id='";
                            echo "$riga[idregione]";
                            echo "'>";
                            echo "$riga[nomeregione]";
                            echo "</paper-item>";
                        }

                        mysqli_close($conn);
                    ?>
                </paper-listbox>
            </paper-dropdown-menu>
            <input type="text" name="comunehidden" value="" id="comunehidden" style="display:none">
            <div id="province"></div>
            <div id="comune"></div>
            <paper-input required name="password" label="Password" type="password"></paper-input>
            <paper-input required name="repeat_password" label="Repeat Password" type="password"></paper-input>
            <paper-textarea name="description" label="Description" type="text" char-counter maxlength="300"></paper-textarea>
            <input type="text" name="descriptionhidden" value="" id="descriptionhidden" style="display:none">
            <br><br>
            <paper-button onclick="submitForm()">Submit</paper-button>
            <button type="submit" id="SubmitButton" name="submit" style="display:none"></button>
            
        </form>
    </div>
</div>
<!-- Fine Register  -->

<?php require 'footer.php';?>

<script>
    $( "paper-textarea[name=description]" ).change(function() {
        document.getElementById('descriptionhidden').value=this.value;
    });
    function selezionecomune(str) {
        document.getElementById('comunehidden').value=str; 
    }

    function regionselect(str) {
        document.getElementById("comune").innerHTML = "";
        var xhttp;
        if (str.length == 0) { 
            document.getElementById("province").innerHTML = "";
            return;
        }
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById("province").innerHTML = xhttp.responseText;
            }
        };
        xhttp.open("GET", "getprovince.php?idregione="+str, true);
        xhttp.send();   
    }
    function provinceselect(str) {
        var xhttp;
        if (str.length == 0) { 
            document.getElementById("comune").innerHTML = "";
            return;
        }
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById("comune").innerHTML = xhttp.responseText;
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
        document.getElementById('SubmitButton').click();
        console.log("Submitted!");
    }

    $("#fileToUpload").change(function(){
        readURL(this);
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