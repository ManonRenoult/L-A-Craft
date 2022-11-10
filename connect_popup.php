<?php
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

/*if(isset($_COOKIE['loginConnect_btn'],$_COOKIE['mdpConnect_btn'])) {
    $pseudo = $_COOKIE['loginConnect_btn'];
    $passPost = $_COOKIE['mdpConnect_btn'];
    $passBDD = getPass($pseudo, $bdh);
    $RescueSha = substr($passBDD, -64);
    $rescueSalt = substr($passBDD, -81, 16);
    $passACheck = encryptPass($passPost, $rescueSalt);
    if ($passACheck === $passBDD) {
        $_SESSION['loginConnect_btn'] = $pseudo;
        header("Location: $link");
    } else {
        header("location: $link" . "?bad_connect=1");
    }
}*/

if (isset($_POST['mdpConnect_btn'], $_POST['loginConnect_btn'])) {
    if(isset($_POST['g-recaptcha-response'])){
        if (isset($_POST['mdpConnect_btn'], $_POST['loginConnect_btn'])) {
            $secret_key = '6Le-tlMgAAAAABvXhQsjg2Dg3VU-9bG3MgiO5q-X';
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response'];
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            $data = curl_exec($curl);
            curl_close($curl);
            $response = json_decode($data);

            if ($response->success) {
                $pseudo = $_POST['loginConnect_btn'];
                $passPost = $_POST['mdpConnect_btn'];
                $passBDD = getPass($pseudo, $bdh);
                $RescueSha = substr($passBDD, -64);
                $rescueSalt = substr($passBDD, -81, 16);
                $passACheck = encryptPass($passPost, $rescueSalt);
                if ($passACheck === $passBDD) {
                    $_SESSION['loginConnect_btn'] = $pseudo;
                    /*if(isset($_POST['saveMeConnect_btn'])) {
                        setcookie('loginConnect_btn',$pseudo,time()+365*24*3600,null,null,false,true);
                        setcookie('mdpConnect_btn',$passPost,time()+365*24*3600,null,null,false,true);
                    }*/
                    header("Location: $link");
                } else {
                    header("location: $link" . "?bad_connect=1");
                }
            }
        }else {
            header("location: $link" . "?bad_connect=2");
        }
    }else{
        header("location: $link" . "?bad_connect=3");
    }
}

?>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    function openPopup(popup) {
        $(popup).fadeIn(150);
        $("#closePopup").focus();
    }

    function closePopup(popup) {
        $(popup).fadeOut(150);
        $("#openMyPopup").focus();
    }
    function onSubmit(token) {
        document.getElementById("form_connect_popup").submit();
    }
</script>
<div class="popup" id="myPopup" aria-hidden="true" onClick="if(event.target == this){closePopup('#myPopup');}">
    <form method="post" action="" id="form_connect_popup">
        <div class="wrapper" aria-labelledby="popupTitle" aria-describedby="popupText" aria-modal="true">
            <div class="TitleConnect">
                <h1>Connexion</h1>
            </div>
            <span class="course_divider"><hr></span>
            <div class="pseudoFormConnect">
                <label for="loginConnect_btn">Login</label>
                <div class="new-chat-window">
                    <i class="fa fa-user-circle-o"></i>
                    <input type="text" class="new-chat-window-input" placeholder="Pseudo" name="loginConnect_btn" id="loginConnect_btn" disabled/>
                </div>
            </div>
            <div class="mdpFormConnect">
                <label for="mdpConnect_btn">Mot de passe</label>
                <div class="new-chat-window">
                    <i class="fa fa-unlock-alt"></i>
                    <input type="password" class="new-chat-window-input" placeholder="*************" name="mdpConnect_btn" id="mdpConnect_btn" disabled/>
                </div>
            </div>
            <div class="saveMeConnect">
                <!--<input type="checkbox" id="saveMeConnect_btn" name="saveMeConnect_btn">
                <label for="saveMeConnect_btn">Se souvenir de moi</label>-->
            </div>
            <div class="btnConnectForm">
                <button type="submit" class="g-recaptcha btnConnectForm_btn" data-sitekey="6Le-tlMgAAAAAMYR5njZLeDELUdd27EMzLSKqnEB" data-callback='onSubmit' disabled>Se connecter</button>
            </div>
            <div class="txtConnectForm">
                <p>Le Nom d'utilisateur dois être celui de votre compte Minecraft</p>
                <p>Et le mot de passe dois être le meme qu'a la connexion au serveur L-A-Craft</p>
            </div>
        </div>
    </form>
</div>