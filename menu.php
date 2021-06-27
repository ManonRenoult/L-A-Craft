<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="fr" class="maxHeight">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Isayev Server</title>
</head>
<body class="maxHeight">
<?php
//    Erreur de connexion
if (isset($_GET['bad_connect']) && $_GET['bad_connect'] == "1") {
    echo '<div class="alert alert-danger" role="alert" id="errorCheck">Pseudo ou mot de passe incorrect</div>';
}

if(isset($erreur)) {
    echo $erreur;
}
if(isset($validation)) {
    echo $validation;
}
?>
    <div class="globalMenu">
        <div class="container-fluid containerA">
            <div class="row menuBar maxHeight">
                <div class="col-10 maxHeight">
                    <ul class="menuA">
                        <a href="#" onclick="document.location.href='./index.php';"><li>Accueil</li></a>
                        <a href="#" onclick="document.location.href='./index.php';"><li>Map</li></a>
                        <a href="#" onclick="document.location.href='./index.php';"><li>Voter</li></a>
                        <a href="#" onclick="document.location.href='./index.php';"><li>Wiki</li></a>
                    </ul>
                </div>
                <div class="col-2 maxHeight">
                    <ul class="menuB">
                        <a href="#" onclick="document.location.href='./<?php if(!empty($_SESSION['username']) && !empty($_SESSION['mdp'])){echo 'deconnexion';}else {echo 'connect';} ?>.php';"><li><div class="btnConnect"><img src="images/user.svg" height="50%" width="20%">&nbsp;<?php if(!empty($_SESSION['username']) && !empty($_SESSION['mdp'])){echo 'Se déconnecter';}else {echo 'Se connecter';}?></div></li></a>'
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid containerAB">
            <div class="row maxHeight">
                <div class="offset-lg-4 offset-md-3 offset-sm-3 col-lg-4 col-md-6 col-sm-6 maxHeight rowNbPlayer">

                    <div id="nbPLayer"><img src="images/world.png" width="10%" height="50%">&nbsp;&nbsp;Chargement ...</div>
                </div>
            </div>
        </div>
    </div>
