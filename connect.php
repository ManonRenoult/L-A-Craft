<?php
include 'menu.php';
$_SESSION['link'] = $_SERVER['PHP_SELF'];
$link = $_SESSION['link'];

function encryptPass($Pass, $randomSalt2) {
    $firstHash = hash('sha256', $Pass);
    $secondHash = hash('sha256', $firstHash.$randomSalt2);
    $endPass = "$"."SHA$" . $randomSalt2 . "$" . $secondHash;
    return $endPass;
}

function getPass($userForTest, $bdh) {
    $endPass = '';
    $getPassword = $bdh->prepare("SELECT * FROM authme where realname = ?");
    $getPassword->execute(array($userForTest));
    $allPassGet = $getPassword->fetchAll();
    foreach ($allPassGet as $passGet) {
        $endPass = $passGet['password'];
    }
    return $endPass;
}

try{
    $bdh = new PDO('mysql:host=frhb62360ds.ikexpress.com;dbname=s1_IsayevDB', 'u1_PlNrhoxlDp', 'DlJor==WI5YEM84TYgzgsOew' );
    $bdh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
}

if (isset($_POST['formconnect'])) {
    if (isset($_POST['username']) && isset($_POST['mdp'])) {
        $pseudo = $_POST['username'];
        $passPost = $_POST['mdp'];
        $passBDD = getPass($pseudo,$bdh);
        $RescueSha = substr($passBDD, -64);
        $rescueSalt = substr($passBDD, -81,16 );
        $passACheck = encryptPass($passPost,$rescueSalt);
        if ($passACheck == $passBDD) {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['mdp'] = $_POST['mdp'];
            header("Location: ./index.php");
        } else {
            header("location: $link" . "?bad_connect=1");
        }
    }else {
        header("location: $link" . "?bad_connect=2");
    }
}
?>
    <div class="container">
        <form method="post" action="">
            <div class="row">
                <h1 class="offset-3 col-4">Connexion</h1>
                <div class="col-4"><a href="#" style="text-decoration: none;" onclick="document.location.href='./inscription.php';"><div class="btn btn-primary" style="background-color: #0a58ca">S'inscrire</div></a></div>
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