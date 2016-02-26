<?php require 'head.php';?>

<title>Account</title>

<style is="custom-style">
    .title {
        @apply(--paper-font-title);
        background-color: #424242;
        color:white;
        @apply(--layout-horizontal);
        @apply(--layout-center);
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
        padding: 0px;
    }

    .number {
        @apply(--paper-font-title);
        color: var(--light-primary-color);
        margin-bottom: 5px;
    }

    .subtitle {
        @apply(--paper-font-caption);
        color: var(--secondary-text-color);
    }

    .description {
        @apply(--paper-font-common-base);

        font-size: 16px;
        font-weight: 400;
        line-height: 24px;
        color: var(--light-primary-color);
    }

    paper-tooltip {
        --paper-tooltip-background: var(--primary-color);
        --paper-tooltip-opacity:1;
    }

    .card:hover {
        cursor: pointer;
    }

    .card:hover:before {
        @apply(--layout-fit);
        background: currentColor;
        content: '';
        opacity: var(--dark-divider-opacity);
        pointer-events: none;
    }

    .card {
        padding: 24px;
        text-align: center;
        position: relative;
        display: inline-block;
        background-color: #fff;
    }

    .card +.card {
        border-left:1px solid var(--divider-color);
    }

    @media only screen and (max-width : 992px) {
        div.card:nth-of-type(1) {
            border-right:1px solid var(--divider-color);
        }
        div.card:nth-of-type(3) {
            border-right:1px solid var(--divider-color);
        }
        div.card:nth-of-type(5) {
            border-right:1px solid var(--divider-color);
        }
        .card +.card {
            border-left:0px solid var(--divider-color);
        }
        .card {
            border-bottom:1px solid var(--divider-color);
        }
        #followed-collection {
            border-bottom:0px solid var(--divider-color);;
        }
        #my-collection {
            border-bottom:0px solid var(--divider-color);;
        }
    }

    @media only screen and (max-width : 600px) {
        div.card:nth-of-type(1) {
            border-right:0px solid var(--divider-color);
        }
        div.card:nth-of-type(3) {
            border-right:0px solid var(--divider-color);
        }
        div.card:nth-of-type(5) {
            border-right:0px solid var(--divider-color);
        }
        .card +.card {
            border-top:1px solid var(--divider-color);
        }
        .card {
            border-bottom:0px solid var(--divider-color);
        }
    }

</style>

<?php require 'navbar.php';?>

<div class="centered" style="margin-top:24px; max-width: 100%;">
    <div class="vertical-section" style="padding:0;">
        <?php 
            echo "<div class=\"title\" style=\"padding:24px\">"
            ."<iron-icon onclick=\"location.href ='login.php?logout=true'\" id=\"logout\" icon=\"exit-to-app\" style=\"margin-right:24px; cursor:pointer\"></iron-icon>"
            .$_SESSION["NOME"]." "
            .$_SESSION["COGNOME"]
            ."<div class=\"flex\"></div>"
            ."<iron-icon onclick=\"location.href ='changeInformation.php?change=true'\" id=\"settings\" icon=\"settings\" style=\"cursor:pointer\"></iron-icon></div>";
        ?>
        <paper-tooltip for="logout" position="top" offset="0" animation-delay="0">Logout</paper-tooltip>
        <paper-tooltip for="settings" position="top" offset="0" animation-delay="0">Settings</paper-tooltip>
        <div style="padding:24px; background-image:url('img/bg1.jpg'); background-size:cover">
            <div id="avatar">
                <?php  
                    echo "<img id=\"preview\" src='".requestPath()."/profile.jpg'>";
                ?>
                <img id="preview" src="img/default.jpg" >
            </div>
        </div>
        <div class="account">
            <div class="sections row" style="margin-bottom:0;">
                <div class="card col l2 m6 s12" id="following">
                    <div class="number">24</div>
                    <div class="subtitle">FOLLOWING</div>
                    <paper-ripple recenters></paper-ripple>
                </div>
                <div class="card col l2 m6 s12" id="follower">
                    <div class="number">122</div>
                    <div class="subtitle">FOLLOWERS</div>
                    <paper-ripple recenters></paper-ripple>
                </div>
                <div class="card col l2 m6 s12" id="likes">
                    <div class="number">32</div>
                    <div class="subtitle">LIKES</div>
                    <paper-ripple recenters></paper-ripple>
                </div>
                <div class="card col l2 m6 s12" id="projects">
                    <div class="number">12</div>
                    <div class="subtitle">PROJECTS</div>
                    <paper-ripple recenters></paper-ripple>
                </div>
                <div class="card col l2 m6 s12" id="my-collection">
                    <div class="number">27</div>
                    <div class="subtitle">MY COLLECTION</div>
                    <paper-ripple recenters></paper-ripple>
                </div>
                <div class="card col l2 m6 s12" id="followed-collection">
                    <div class="number">24</div>
                    <div class="subtitle">FOLLOWED COLLECTION</div>
                    <paper-ripple recenters></paper-ripple>
                </div>
            </div>
            <div class="description row">
                <div class="col s12">
                
                </div>
            </div>
            <div class="submit-button-container" style="display:none">
                <button type="button" name="logout" onclick="logout()">Logout</button>
                <p>
                <?php
                    print_r($_SESSION);
                ?></p>
            </div>
        </div>

    </div>
    <div class="vertical-section" style="padding:0;">
        <div class="title" style="padding:24px; margin-top:24px; background-color:#fc183d; ">
            <iron-icon icon="description" style="margin-right:24px;"></iron-icon>
            Description
        </div>
        <div class="description" style="padding:24px">
        <?php 
            echo requestData()["DESCRIPTION"];
        ?>
        </div>
    </div>
</div>

<!-- ___________________________________ --> 

<?php require 'footer.php';?>

<?php require 'close.php';?>