<?php
include 'menu.php';
if (isset($_POST['forminscription'])) {
    try{
        $bdh = new PDO('mysql:host=frhb62360ds.ikexpress.com;dbname=s1_IsayevDB', 'u1_PlNrhoxlDp', 'DlJor==WI5YEM84TYgzgsOew' );
        $bdh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Erreur : " . $e->getMessage();
    }
    if (!empty($_POST['username']) && !empty($_POST['mdp']) && !empty($_POST['mdp2'])) {
        $username = htmlspecialchars($_POST['username']);
        //$mdp = sha1($_POST['mdp']);
        //$mdp2 = sha1($_POST['mdp2']);
        $mdp = $_POST['mdp'];
        $mdp2 = $_POST['mdp2'];
        if (strlen($username) <= 50) {
            $reqpseudo = $bdh->prepare("SELECT * FROM membresWeb WHERE username = ?");
            $reqpseudo->execute(array($username));
            $pseudoexist = $reqpseudo->rowCount();
            if ($pseudoexist == 0) {
                if ($mdp == $mdp2) {

                    $insertmbr = $bdh->prepare("INSERT INTO membresWeb(username, password) VALUES(?, ?)");
                    $insertmbr->execute(array($username, $mdp));
                    $validation = header('./index.php');

                } else {
                    $erreur = '<div class="alert alert-danger" role="alert" id="errorCheck">Vos Mot de passe de corresponde pas !</div>';

                }
            } else {
                $erreur = '<div class="alert alert-danger" role="alert" id="errorCheck">Ce pseudo existe deja !</div>';

            }
        } else {
            $erreur = '<div class="alert alert-danger" role="alert" id="errorCheck">Votre Pseudo est trop grand !</div>';

        }
    } else {
        $erreur = '<div class="alert alert-danger" role="alert" id="errorCheck">Tous les champs doivent être complétés !</div>';

    }
}
?>
<div class="container">
    <form method="post" action="">
        <div class="row">
            <h1 class="offset-3 col-6">Inscription</h1>
        </div>

        <div class="row">
            <label class="offset-3 col-6" for="username">Nom d'utilisateur :</label>
        </div><div class="row">
            <input class="offset-3 col-6" type="text" placeholder="Votre nom d'utilisateur" name="username" id="username">
        </div>
        <div class="row">
            <label class="offset-3 col-6" for="mdp">Mot de passe :</label>
        </div><div class="row">
            <input class="offset-3 col-6" type="password" placeholder="Votre mot de passe" name="mdp" id="mdp">
        </div>
        <div class=" row">
            <label class="offset-3 col-6" for="mdp2">Confirmation du mot de passe :</label>
        </div><div class="row">
            <input class="offset-3 col-6" type="password" placeholder="Confirmez votre mot de passe" name="mdp2" id="mdp2">
        </div>
        <br>
        <div class=" row">
            <div class="offset-3 col-6">
                <div class="row">
                    <button class="btn btn-primary" name="forminscription" type="submit">Je m'inscris</button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php include 'footer.php'; ?>