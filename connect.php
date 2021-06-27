<?php
include 'menu.php';

try{
    $bdh = new PDO('mysql:host=frhb62360ds.ikexpress.com;dbname=s1_IsayevDB', 'u1_PlNrhoxlDp', 'DlJor==WI5YEM84TYgzgsOew' );
    $bdh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
}
$_SESSION['link'] = $_SERVER['PHP_SELF'];
$link = $_SESSION['link'];
//recuperation des données de connexion//
if (isset($_POST['formconnect'])) {
    $pseudo = $_POST['username'];
    //$mdp = sha1($_POST['mdp']);
    $mdp = $_POST['mdp'];
    $reqidentifiant = $bdh->prepare("SELECT * FROM membresWeb WHERE username = ? AND password = ?");
    $reqidentifiant->execute(array($pseudo, $mdp));
    $identifiantexist = $reqidentifiant->rowCount();


    //verification des données de connexion//
    if ($identifiantexist != 0) {

        $_SESSION['username'] = $_POST['username'];
        $_SESSION['mdp'] = $_POST['mdp'];
        header("Location: ./index.php");
    } else {
        header("location: $link" . "?bad_connect=1");
    }
}else {
    $erreur = '<div class="alert alert-danger" role="alert" id="errorCheck">Tous les champs doivent être complétés !</div>';
}
?>
    <div class="container">
        <form method="post" action="">
            <div class="row">
                <h1 class="offset-3 col-4">Connexion</h1>
                <div class="col-4"><a href="#" style="text-decoration: none;" onclick="document.location.href='./inscription.php';"><div class="btn" style="background-color: #0a58ca">S'inscrire</div></a></div>
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

            <br>
            <div class=" row">
                <div class="offset-3 col-6">
                    <div class="row">
                        <button class="btn btn-primary" name="formconnect" type="submit">Connexion</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php include 'footer.php'; ?>