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
                    $usernameLower = strtolower($username);
                    $insertmbr = $bdh->prepare("INSERT INTO authme(username,realname, password) VALUES(?,?, ?)");
                    $insertmbr->execute(array($usernameLower,$username, $mdp));
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