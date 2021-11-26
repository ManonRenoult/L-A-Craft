<?php
include 'menu2.php';
$_SESSION['link'] = $_SERVER['PHP_SELF'];
$link = $_SESSION['link'];
if (!empty ($_SESSION['username'])) {
    header("Location: ./");
}
function encryptPass($Pass, $randomSalt2)
{
    $firstHash = hash('sha256', $Pass);
    $secondHash = hash('sha256', $firstHash . $randomSalt2);
    $endPass = "$" . "SHA$" . $randomSalt2 . "$" . $secondHash;
    return $endPass;
}

function getPass($userName, $bdh)
{
    $endPass = '';
    $getPassword = $bdh->prepare("SELECT * FROM authme where realname = ?");
    $getPassword->execute(array($userName));
    $allPassGet = $getPassword->fetchAll();
    foreach ($allPassGet as $passGet) {
        $endPass = $passGet['password'];
    }
    return $endPass;
}

function getAllParameters($userName, $bdh)
{
    $userNameLower = strtolower($userName);
    $getParams = $bdh->prepare("SELECT * FROM luckperms_players where username = ?");
    $getParams->execute(array($userNameLower));
    $allParamGet = $getParams->fetchAll();
    foreach ($allParamGet as $paramGet) {
        $_SESSION['uuidLuckPerm'] = $paramGet['uuid'];
    }
    $getParams = $bdh->prepare("SELECT * FROM luckperms_user_permissions where uuid = ?");
    $getParams->execute(array($_SESSION['uuidLuckPerm']));
    $allParamGet = $getParams->fetchAll();
    foreach ($allParamGet as $paramGet) {
        $rang = ucfirst(substr($paramGet['permission'], 6));
        if ($userName == 'RetroManiiia' || $userName == 'Ryukkk__') {
            $_SESSION['rang'] = 'Fondateur';
        } else {
            if ($rang == 'Default') {
                $_SESSION['rang'] = 'Membre';
            } else {
                $_SESSION['rang'] = $rang;
            }
        }
        $_SESSION['permission'] = $paramGet['permission'];
    }
    $getParams = $bdh->prepare("SELECT * FROM jobs_users where username = ?");
    $getParams->execute(array($_SESSION['username']));
    $allParamGet = $getParams->fetchAll();
    foreach ($allParamGet as $paramGet) {
        $arr = explode(":", $paramGet['quests'], 2);
        $jobs = $arr[0];
        $_SESSION['jobs'] = $jobs;
        $_SESSION['uuidJob'] = $paramGet['player_uuid'];
    }
    $getParams = $bdh->prepare("SELECT * FROM Economy where Name = ?");
    $getParams->execute(array($_SESSION['uuidLuckPerm']));
    $allParamGet = $getParams->fetchAll();
    foreach ($allParamGet as $paramGet) {
        $_SESSION['moneyEconomy'] = $paramGet['Balance'];
    }
}

try {
    $bdh = new PDO('mysql:host=frhb62360ds.ikexpress.com;dbname=s1_IsayevDB', 'u1_PlNrhoxlDp', 'DlJor==WI5YEM84TYgzgsOew');
    $bdh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

if (isset($_POST['formconnect'])) {
    /*if($_POST['g-recaptcha-response'] != ""){*/
    if (isset($_POST['username']) && isset($_POST['mdp'])) {
        /*$secret = '6Le1u4kbAAAAAIwrtgRaFB5ad7YCOB8iLlC7A8Dn';
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        if ($responseData->success) {*/
        $pseudo = $_POST['username'];
        $passPost = $_POST['mdp'];
        $passBDD = getPass($pseudo, $bdh);
        $RescueSha = substr($passBDD, -64);
        $rescueSalt = substr($passBDD, -81, 16);
        $passACheck = encryptPass($passPost, $rescueSalt);
        if ($passACheck == $passBDD) {
            $_SESSION['username'] = $pseudo;
            $_SESSION['mdp'] = $passPost;
            $_SESSION['start'] = time();
            $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
            getAllParameters($_SESSION['username'], $bdh);
            if ((isset($_GET['connectOption']))) {
                if ($_GET['connectOption'] = 1) {
                    header("Location: ./voter");
                } else {

                    header("Location: ./");
                }
            } else {
                header("Location: ./");
            }
        } else {
            header("location: $link" . "?bad_connect=1");
        }
        /*}*/
    } else {
        header("location: $link" . "?bad_connect=2");
    }
    /*}else{
        header("location: $link" . "?bad_connect=3");
    }*/
}
?>
    <div class="container zIndex3 containerConnect">
        <div class="row">
            <div class="col-12">
                <form method="post" action="" class="formConnect">
                    <div class="row">
                        <h1 class="offset-3 col-4">Connexion</h1>
                        <div class="col-4">Pas encore inscrit ?&nbsp;<a href="#" style="text-decoration: none;"
                                                                        onclick="document.location.href='./inscription';">
                                <div class="btn btn-success">S'inscrire</div>
                            </a></div>
                    </div>
                    <div class="row">
                        <label class="offset-3 col-6" for="username">Nom d'utilisateur Minecraft :</label>
                    </div>
                    <div class="row">
                        <input class="offset-3 col-6" type="text" placeholder="Votre nom d'utilisateur" name="username"
                               id="username">
                    </div>

                    <br>
                    <div class="row">
                        <label class="offset-3 col-6" for="mdp">Mot de passe :</label>
                    </div>
                    <div class="row">
                        <input class="offset-3 col-6" type="password" placeholder="Votre mot de passe" name="mdp"
                               id="mdp">
                    </div>
                    <div class="row" style="padding-top:2.5%">
                        <div class="offset-3 col-6 g-recaptcha"
                             data-sitekey="6Le1u4kbAAAAACM8ajaPEq-kw0S0RzCuRV9FRPy1"></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="offset-3 col-6 boxAttention">
                            <p class="titleBoxAttention">Attention !!!</p>
                            <p>Le Nom d'utilisateur dois être celui de vôtre compte Minecraft</p>
                            <p>Et le mot de passe dois être le meme qu'a la connexion au serveur L-A-Craft</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="offset-3 col-6">
                            <button class="btn btn-primary" name="formconnect" type="submit">Connexion</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php include 'footer2.php'; ?>