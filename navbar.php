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
                <?php  
                    if (empty($_SESSION["ID"])) {
                        echo "<paper-icon-item onclick='location.href = 'login.php''>";
                            echo "<iron-icon icon='account-circle' item-icon></iron-icon> Login";
                        echo "</paper-icon-item>";
                    } else {
                        echo "<paper-icon-item onclick='location.href = 'account.php''>";
                            echo "<iron-icon icon='account-circle' item-icon></iron-icon> Account";
                        echo "</paper-icon-item>";
                    }
                ?>
                </paper-header-panel>

            <paper-header-panel mode="waterfall" main class="header-main">

                <paper-toolbar class="main">
                    <div class="flex center horizontal layout  field">
                        <paper-icon-button icon="menu" paper-drawer-toggle style="color:#424242; margin-right:0;"></paper-icon-button>
                        <input placeholder="Search..." class="flex left">
                    </div>
                </paper-toolbar>