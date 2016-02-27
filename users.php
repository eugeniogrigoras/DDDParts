<?php require 'head.php';?>

<title>Users</title>

<style is="custom-style">
	.utente {
		@apply(--shadow-elevation-2dp);
	}
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
        width: 100px;
        height: 100px;
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
        font-size: 15px;
        color: var(--light-primary-color);
        margin-bottom: 5px;
    }

    .subtitle {
        @apply(--paper-font-caption);
        font-size: 9px;
        color: var(--secondary-text-color);
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
        padding: 12px 24px;
        text-align: center;
        position: relative;
        display: inline-block;
        background-color: #fff;
    }

    .card +.card {
        border-left:1px solid var(--divider-color);
    }

    @media only screen and (max-width : 992px) {
    	.utente-box {
    		padding-right: 0px!important;
    	}
    }
</style>

<?php require 'navbar.php';?>

<div class="row" style="padding:24px; padding-bottom:0; margin-bottom:0">
	<?php
		$USERS=executeQuery("select * from utenti");
		if ($USERS) {
			if ($USERS->num_rows > 0) {
				$cont=0;
				while ($riga=$USERS->fetch_assoc()) {
					getUtente($riga["ID"], $riga["NOME"], $riga["COGNOME"], $riga["EMAIL"], $riga["FK_COMUNE"], $cont);
					$cont++;
				}
			}
		}
	?>
</div>

<?php require 'footer.php';?>

<script>
	
</script>

<?php require 'close.php';?>