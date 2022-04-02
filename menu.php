<?php
//    Erreur de connexion
if (isset($_GET['bad_connect'])) {
    if($_GET['bad_connect'] == "1"){
        echo '<div class="message_error_red" id="errorCheck"><div>Pseudo ou mot de passe incorrect</div></div>';
    }elseif ($_GET['bad_connect'] == "2"){
        echo '<div class="message_error_red" id="errorCheck"><div>Tous les champs doivent être complétés !</div></div>';
    }elseif ($_GET['bad_connect'] == "3"){
        echo '<div class="message_error_red" id="errorCheck"><div>Veuillez coché le Captcha !</div></div>';
    }
}
/*elseif (isset($_GET['bad_vote'])){
    if($_GET['bad_vote'] == "1"){
        echo '<div class="message_error_red" id="errorCheck"><div>Vous devez etre connecter pour voter !</div></div>';
    }elseif($_GET['bad_vote'] == "2"){
        echo '<div class="message_error_red" id="errorCheck"><div>Vous avez deja voter il y a moins de 3H !</div></div>';
    }elseif($_GET['bad_vote'] == "3"){
        echo '<div class="message_error_red" id="errorCheck"><div>[ID INVALIDE] L ID du serveur ne correspond pas !</div></div>';
    }elseif($_GET['bad_vote'] == "4"){
        echo '<div class="message_error_red" id="errorCheck"><div>[IP INVALIDE] La requête ne vient pas de Liste-serveurs-minecraft.org !</div></div>';
    }
} elseif (isset($_GET['ok_vote'])){
    if($_GET['ok_vote'] == "1"){
        echo '<div class="message_error_green" id="errorCheck"><div>Votre vote a ete pris en compte !</div></div>';
    }
}*/
?>
<div class="header">
    <div class="child_header_grid">
        <div class="child_header_menu">
            <ul>
                <a href="#" onclick="document.location.href='./';">
                    <li>Accueil</li>
                </a>
                <a href="#" onclick="document.location.href='./map';">
                    <li class="two">Map</li>
                </a>
                <a href="#" onclick="document.location.href='./voter';">
                    <li class="three">Voter</li>
                </a>
                <a href="#" onclick="document.location.href='./wiki';">
                    <li class="four">Wiki</li>
                </a>
                <a href="#" onclick="document.location.href='./status';">
                    <li class="five">Status</li>
                </a>
                <?php
                    if(!empty($_SESSION['username']) && !empty($_SESSION['mdp'])){
                        echo '<a href="#" onclick="document.location.href=\'./profil.php\'"><li class="six">Profil</li></a>';
                    }
                ?>
                <a href="#" onclick="document.location.href='./<?php if(!empty($_SESSION['username']) && !empty($_SESSION['mdp'])){echo 'deconnexion';}else {echo 'connect';} ?>.php';">
                    <li class="menu_btn_connect"><?php if(!empty($_SESSION['username']) && !empty($_SESSION['mdp'])){echo 'Se Deconnecter';}else{echo 'Se connecter';}?></li>
                </a>
            </ul>
        </div>
        <div class="child_header_logo">
            <img class="logo_header" title="L-A-Craft" src="images/logo_laacraft3.png" alt="logo" />
        </div>
        <div class="child_header_player">
            <div id="copy_target" title="Cliqué pour copié l'ip dans le presse papier !">
                <div id="nbPLayer"><i class="fa fa-users"></i>&nbsp;&nbsp;Chargement ...</div>
                <div class="targetServer" id="content-copy">play.l-a-craft.fr</div>
            </div>
        </div>
        <div class="child_header_online_discord">
            <div class="online_member_discord"><i class="fa-brands fa-discord"></i>&nbsp;&nbsp;Communauté Discord<br><b class="color_number_member_discord">456</b> membres en ligne</div>
        </div>
    </div>
</div>

<div id="notif_copy" class="notif_copy">
    <p>L'ip a été copié dans le presse papier !</p>
</div>