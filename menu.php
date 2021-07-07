<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="fr" class="maxHeight">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/3821d4a8a5.js" crossorigin="anonymous"></script>

    <title>Isayev Server</title>
</head>
<?php
//    Erreur de connexion
if (isset($_GET['bad_connect'])) {
    if($_GET['bad_connect'] == "1"){
        echo '<div class="container-fluid" id="errorCheck"><div class="row"><div class="offset-2 col-8"><div class="alert alert-danger zIndex2" role="alert" id="errorCheck">Pseudo ou mot de passe incorrect</div></div></div></div>';
    }elseif ($_GET['bad_connect'] == "2"){
        echo '<div class="container-fluid" id="errorCheck"><div class="row"><div class="offset-2 col-8"><div class="alert alert-danger zIndex2" role="alert" id="errorCheck">Tous les champs doivent être complétés !</div></div></div></div>';
    }
} elseif (isset($_GET['bad_inscription'])){
    if($_GET['bad_inscription'] == "1"){
        echo '<div class="container-fluid" id="errorCheck"><div class="row"><div class="offset-2 col-8"><div class="alert alert-danger zIndex2" role="alert" id="errorCheck">Vos Mot de passe de corresponde pas !</div></div></div></div>';
    }elseif ($_GET['bad_inscription'] == "2"){
        echo '<div class="container-fluid" id="errorCheck"><div class="row"><div class="offset-2 col-8"><div class="alert alert-danger zIndex2" role="alert" id="errorCheck">Ce pseudo existe deja !</div></div></div></div>';
    }elseif ($_GET['bad_inscription'] == "3"){
        echo '<div class="container-fluid" id="errorCheck"><div class="row"><div class="offset-2 col-8"><div class="alert alert-danger zIndex2" role="alert" id="errorCheck">Votre Pseudo est trop grand !</div></div></div></div>';
    }elseif ($_GET['bad_inscription'] == "4"){
        echo '<div class="container-fluid" id="errorCheck"><div class="row"><div class="offset-2 col-8"><div class="alert alert-danger zIndex2" role="alert" id="errorCheck">Tous les champs doivent être complétés !</div></div></div></div>';
    }
} elseif (isset($_GET['ok_inscription'])){
    if($_GET['ok_inscription'] == "1"){
        echo '<div class="container-fluid" id="errorCheck"><div class="row"><div class="offset-2 col-8"><div class="alert alert-success zIndex2" role="alert" >Votre compte a bien été crée !</div></div></div></div>';
    }
}
?>
<body class="maxHeight zIndex1">
<div class="menusize">
    <div class="globalMenu">
        <div class="container-fluid containerA">
            <div class="row menuBar maxHeight">
                <?php
                if(!empty($_SESSION['username']) && !empty($_SESSION['mdp'])){
                    echo '<div class="col-8 col-md-6 maxHeight">';
                }else{
                    echo '<div class="col-9 col-md-6 maxHeight">';
                }
                ?>
                <ul class="menuA">
                    <a href="#" onclick="document.location.href='./index.php';"><li>Accueil</li></a>
                    <a href="#" onclick="document.location.href='./map.php';"><li>Map</li></a>
                    <a href="#" onclick="document.location.href='./voter.php';"><li>Voter</li></a>
                    <a href="#" onclick="document.location.href='./wiki.php';"><li>Wiki</li></a>
                </ul>
            </div>
            <div class="col-2 col-md-4 maxHeight">
            <?php
            if(!empty($_SESSION['username']) && !empty($_SESSION['mdp'])){
                echo '
                            
                           <ul class="menuB">
                               <a href="#" onclick="document.location.href=\'./profil.php\'"><li><div class="btnConnect">Mon profil</div></li></a>
                           </ul>
                           ';
            }
            ?>

            </div>
        <div class="col-1 col-md-2 maxHeight">

            <ul class="menuB">
                <a href="#" onclick="document.location.href='./<?php if(!empty($_SESSION['username']) && !empty($_SESSION['mdp'])){echo 'deconnexion';}else {echo 'connect';} ?>.php';"><li class="<?php if(!empty($_SESSION['username']) && !empty($_SESSION['mdp'])){echo 'btnLiDisconnect';}else {echo 'btnconnect';}?>"><i class="fa fa-power-off" aria-hidden="true"></i><?php if(!empty($_SESSION['username']) && !empty($_SESSION['mdp'])){echo '';}else {echo 'Se connecter';}?></li></a>
            </ul>
        </div>


    </div>
</div>
<div class="container-fluid containerAB">
    <div class="row menuTitre">
        <div class="row menuAfftitre">
            <p>Bienvenue sur L.A - server </p>
        </div>
        <div class="row menuAffsoustitre">
            <p>Serveur en 1.16.5</p>
        </div>
        <div class="row menuAffnbjoueurs">
            <div class="offset-3 col-6">
                <div id="nbPLayer"><i class="fas fa-users"></i>&nbsp;&nbsp;Chargement ...</div>

            </div>
        </div>
    </div>
</div>
</div>
</div>
