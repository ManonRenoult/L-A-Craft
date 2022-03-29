<?php
session_start();
include 'bdd.php';
global $bdh;

$_SESSION['link'] = $_SERVER['PHP_SELF'];
$link = $_SESSION['link'];

function encryptPass($Pass, $randomSalt2) {
    $firstHash = hash('sha256', $Pass);
    $secondHash = hash('sha256', $firstHash.$randomSalt2);
    $endPass = "$"."SHA$" . $randomSalt2 . "$" . $secondHash;
    return $endPass;
}

function getPass($userName, $bdh) {
    $endPass = '';
    $getPassword = $bdh->prepare("SELECT * FROM authme where realname = ?");
    $getPassword->execute(array($userName));
    $allPassGet = $getPassword->fetchAll();
    foreach ($allPassGet as $passGet) {
        $endPass = $passGet['password'];
    }
    return $endPass;
}

function getAllParameters($userName, $bdh) {
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
        if($userName == 'RetroManiiia' || $userName == 'Ryukkk__'){
            $_SESSION['rang'] = 'Fondateur';
        }else {
            if ($rang == 'Default'){
                $_SESSION['rang'] = 'Membre';
            }else {
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
        $jobs= $arr[0];
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

if (isset($_POST['formconnect'])) {
    if($_POST['g-recaptcha-response']){
        if (isset($_POST['username'], $_POST['mdp'])) {
            $secret = '6Le1u4kbAAAAAIwrtgRaFB5ad7YCOB8iLlC7A8Dn';
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            try {
                $responseData = json_decode($verifyResponse, false, 512, JSON_THROW_ON_ERROR);
            } catch (JsonException $e) {
            }
            if ($responseData->success) {
                $pseudo = $_POST['username'];
                $passPost = $_POST['mdp'];
                $passBDD = getPass($pseudo, $bdh);
                $RescueSha = substr($passBDD, -64);
                $rescueSalt = substr($passBDD, -81, 16);
                $passACheck = encryptPass($passPost, $rescueSalt);
                if ($passACheck === $passBDD) {
                    $_SESSION['username'] = $pseudo;
                    $_SESSION['mdp'] = $passPost;
                    getAllParameters($_SESSION['username'], $bdh);
                    if ((isset($_GET['connectOption']))){
                        if($_GET['connectOption'] = 1){
                            header("Location: ./voter.php");
                        } else {
                            header("Location: ./index.php");
                        }
                    }else {
                        header("Location: ./index.php");
                    }
                } else {
                    header("location: $link" . "?bad_connect=1");
                }
            }
        }else {
            header("location: $link" . "?bad_connect=2");
        }
    }else{
        echo 'dont ok';
        sleep(5);
        header("location: $link" . "?bad_connect=3");
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css">
        <title>Connexion . L-A Craft</title>
    </head>
    <body>
        <div class="grid">
            <?php include 'menu.php';?>
            <div class="body">
                <div class="body_connect_grid">
                    <form method="post" action="" class="form_connect">
                        <div class="title_form_connect"><h2>Connexion</h2></div>
                        <div class="user_form_connect">
                            <label class="label_user_form_connect" for="username">Nom d'utilisateur Minecraft :</label><br/>
                            <input type="text" name="username" id="username" />
                        </div>
                        <div class="password_form_connect">
                            <label class="label_user_form_connect" for="mdp" >Mot de passe :</label><br/>
                            <input type="password" name="mdp" id="mdp" />
                        </div>
                        <div class="captcha_form_connect">
                            <div class="g-recaptcha" data-sitekey="6Le1u4kbAAAAACM8ajaPEq-kw0S0RzCuRV9FRPy1"></div>
                        </div>
                        <div class="message_form_connect">
                            <div class="boxAttention_form_connect">
                                <p class="titleBoxAttention_form_connect">Attention !!!</p>
                                <p>Le Nom d'utilisateur dois être celui de vôtre compte Minecraft</p>
                                <p>Et le mot de passe dois être le meme qu'a la connexion au serveur L-A-Craft</p>
                            </div>
                        </div>
                        <div class="btn_connect_form_connect">
                            <button name="formconnect" type="submit">Connexion</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php include 'footer.php';?>
        </div>
    </body>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/getPlayer.js"></script>
</html>