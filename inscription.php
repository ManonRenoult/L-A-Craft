<?php
include 'menu.php';

$_SESSION['link'] = $_SERVER['PHP_SELF'];
$link = $_SESSION['link'];

function generateRandomString($length = 16) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function encryptPass($Pass, $randomSalt2) {
    $firstHash = hash('sha256', $Pass);
    $secondHash = hash('sha256', $firstHash.$randomSalt2);
    $endPass = "$"."SHA$" . $randomSalt2 . "$" . $secondHash;
    return $endPass;
}

if (isset($_POST['forminscription'])) {
    try{
        $bdh = new PDO('mysql:host=frhb62360ds.ikexpress.com;dbname=s1_IsayevDB', 'u1_PlNrhoxlDp', 'DlJor==WI5YEM84TYgzgsOew' );
        $bdh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Erreur : " . $e->getMessage();
    }
    if($_POST['g-recaptcha-response'] != "") {
        if (!empty($_POST['username']) && !empty($_POST['mdp']) && !empty($_POST['mdp2'])) {

            $username = htmlspecialchars($_POST['username']);
            $randomSalt = generateRandomString();
            $mdp = encryptPass($_POST['mdp'], $randomSalt);
            $mdp2 = encryptPass($_POST['mdp2'], $randomSalt);

            if (strlen($username) <= 50) {
                $reqpseudo = $bdh->prepare("SELECT * FROM authme WHERE realname = ?");
                $reqpseudo->execute(array($username));
                $pseudoexist = $reqpseudo->rowCount();
                if ($pseudoexist == 0) {
                    if ($mdp == $mdp2) {
                        $date = date_create();
                        $result = $date->format('d/m/Y');
                        $usernameLower = strtolower($username);
                        $insertmbr = $bdh->prepare("INSERT INTO authme(username,realname, password, timetampWeb) VALUES(?,?,?,?)");
                        $insertmbr->execute(array($usernameLower, $username, $mdp, $result));
                        header('Location:  ./index.php?ok_inscription=1');
                    } else {
                        header("location: $link" . "?bad_inscription=1");
                    }
                } else {
                    header("location: $link" . "?bad_inscription=2");
                }
            } else {
                header("location: $link" . "?bad_inscription=3");
            }
        } else {
            header("location: $link" . "?bad_inscription=4");
        }
    }else{
        header("location: $link" . "?bad_inscription=5");
    }
}
?>
<div class="container zIndex3 containerInscript">
    <form method="post" action="">
        <div class="row">
            <h1 class="offset-3 col-6">Inscription</h1>
        </div>
        <div class="row">
            <label class="offset-3 col-6" for="username">Nom d'utilisateur Minecraft :</label>
        </div>
        <div class="row">
            <input class="offset-3 col-6" type="text" placeholder="Votre nom d'utilisateur" name="username" id="username">
        </div>

        <br>
        <div class="row">
            <label class="offset-3 col-6" for="mdp">Mot de passe :</label>
        </div>
        <div class="row">
            <input class="offset-3 col-6" type="password" placeholder="Votre mot de passe" name="mdp" id="mdp">
        </div>

        <br>
        <div class="row">
            <label class="offset-3 col-6" for="mdp2">Confirmation du mot de passe :</label>
        </div>
        <div class="row">
            <input class="offset-3 col-6" type="password" placeholder="Confirmez votre mot de passe" name="mdp2" id="mdp2">
        </div>
        <div class="row" style="padding-top:2.5%">
            <div class="offset-3 col-6 g-recaptcha" data-sitekey="6Le1u4kbAAAAACM8ajaPEq-kw0S0RzCuRV9FRPy1"></div>
        </div>
        <br>
        <div class="row">
            <div class="offset-3 col-6 boxAttention">
                <p class="attentionBox">Attention !!!</p>
                <p>Le Nom d'utilisateur dois étre celui de vôtre compte Minecraft</p>
                <p>Et le mot de passe que vous rentrez serra demander a la connexion au serveur L-A-Craft</p>
            </div>
        </div>
        <div class="row">
            <div class="offset-3 col-6">
                <button class="btn btn-primary" name="forminscription" type="submit">Je m'inscris</button>
            </div>
        </div>
    </form>
</div>
<?php include 'footer.php'; ?>