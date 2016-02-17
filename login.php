<!doctype html>
<html class="no-js" lang="it">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Login</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <!-- Polymer Elements -->
        <link rel="import" href="bower_components/webcomponentsjs/webcomponents.js">
        <link rel="import" href="bower_components/polymer/polymer.html">
        <link rel="import" href="bower_components/paper-scroll-header-panel/paper-scroll-header-panel.html">
        <link rel="import" href="bower_components/paper-header-panel/paper-header-panel.html">
        <link rel="import" href="bower_components/paper-drawer-panel/paper-drawer-panel.html">
        <link rel="import" href="bower_components/paper-icon-button/paper-icon-button.html">
        <link rel="import" href="bower_components/paper-styles/paper-styles.html">
        <link rel="import" href="bower_components/paper-styles/demo-pages.html">
        <link rel="import" href="bower_components/paper-styles/typography.html">
        <link rel="import" href="bower_components/paper-styles/color.html">
        <link rel="import" href="bower_components/iron-icon/iron-icon.html">
        <link rel="import" href="bower_components/iron-icons/iron-icons.html">
        <link rel="import" href="bower_components/iron-icons/av-icons.html">
        <link rel="import" href="bower_components/paper-toolbar/paper-toolbar.html">
        <link rel="import" href="bower_components/paper-input/paper-input.html">
        <link rel="import" href="bower_components/iron-flex-layout/iron-flex-layout.html">
        <link rel="import" href="bower_components/paper-scroll-header-panel/demo/sample-content.html">
        <link rel="import" href="bower_components/paper-item/paper-item.html">
        <link rel="import" href="bower_components/paper-item/all-imports.html">
        <link rel="import" href="bower_components/iron-image/iron-image.html">
        <link rel="import" href="bower_components/paper-button/paper-button.html">
        <link rel="import" href="bower_components/paper-checkbox/paper-checkbox.html">
        <link rel="import" href="bower_components/paper-dropdown-menu/paper-dropdown-menu.html">
        <link rel="import" href="bower_components/paper-menu/paper-menu.html">
        <link rel="import" href="bower_components/iron-form/iron-form.html">
        
        <!-- Fine Polymer Elements -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>


        <style is="custom-style">

            html {
                @apply(--paper-font-common-expensive-kerning);
                @apply(--paper-font-common-base);
            }
            paper-toolbar.main {
                background-color: var(--paper-grey-700);
            }

            paper-toolbar.drawer {
                background-color: var(--paper-grey-800);
            }

            paper-icon-item {
                color: #424242;
                @apply(--paper-font-body2);
            }

            paper-icon-item + paper-icon-item {
                border-bottom: 1px solid #EEEEEE;
            }

            paper-icon-item:hover:before {
                @apply(--layout-fit);
                background: currentColor;
                content: '';
                opacity: var(--dark-divider-opacity);
                pointer-events: none;
            }

            .field {
                background-color: #fff;
                @apply(--shadow-elevation-2dp);
                height: 40px;
                color: #616161;
            }
    
            .field input {
                @apply(--paper-font-caption);
                font-size: 15px;
                outline: 0;
                border: none;
                margin-left: 14px;
            }

            @media only screen and (max-width : 600px) {
                .field input {
                    margin-left: 0;
                }
            }

            @media only screen and (min-width : 601px) {
                paper-header-panel.header-drawer {
                    @apply(--shadow-elevation-2dp);
                }
            }

            paper-toolbar.drawer:hover, paper-header-panel.header-drawer paper-icon-item:hover {
                cursor:pointer;
            }

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

    </head>
    <body>
        
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <paper-drawer-panel >

            <paper-header-panel mode="waterfall" drawer class="header-drawer">
                <paper-toolbar class="drawer" onclick="location.href = 'index.php'">
                    <iron-image style="height:30%" sizing="contain" class="flex" src="img/dddparts-logo.png"></iron-image>
                </paper-toolbar>
                
                <paper-icon-item onclick="location.href = '#'" style="border-bottom: 1px solid #EEEEEE;">
                    <iron-icon icon="dashboard" item-icon></iron-icon> Dashboard
                </paper-icon-item>
                <paper-icon-item onclick="location.href = '#'">
                    <iron-icon icon="explore" item-icon></iron-icon> Explore
                </paper-icon-item>
                <paper-icon-item onclick="location.href = '#'">
                    <iron-icon icon="book" item-icon></iron-icon> Learn
                </paper-icon-item>
                <paper-icon-item onclick="location.href = '#'">
                    <iron-icon icon="create" item-icon></iron-icon> Create
                </paper-icon-item>
                <paper-icon-item onclick="location.href = 'login.php'">
                    <iron-icon icon="account-circle" item-icon></iron-icon> Login
                </paper-icon-item>
            </paper-header-panel>

            <paper-header-panel mode="waterfall" main class="header-main">

                <paper-toolbar class="main">
                    <div class="flex center horizontal layout  field">
                        <paper-icon-button icon="menu" paper-drawer-toggle style="color:#424242; margin-right:0;"></paper-icon-button>
                        <input placeholder="Search..." class="flex left">
                    </div>
                </paper-toolbar>

                <!-- Inizio Sign In  -->
                <div class="centered" style="margin-top:24px">
                    <div class="vertical-section" style="padding:0;">
                        <div class="title" style="padding:24px">Login</div>
                        <form style="padding:24px;" is="iron-form" id="formGet" method="get" action="/">
                            <paper-input name="username" label="Username" type="text" required></paper-input>
                            <paper-input name="password" label="Password" type="password" required></paper-input>
                            <br>
                            <paper-checkbox checked class="grey">Remember me</paper-checkbox>
                            <br><br>
                            <div class="submit-button-container">
                                <paper-button onclick="submitHandler(event)">Login</paper-button>
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

            </paper-header-panel>
        </paper-drawer-panel>

        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html>