
<?php
echo '" ';
define("SERVER_ID", 202960);
define("DEBUG", 1); //Mettre 1 pour activer le debug ou 0 pour désactiver
define("LOG_FILE", "_postback.log");

$lsm_ip = file_get_contents('http://www.liste-serveurs-minecraft.org/get_ip.php');

if($_SERVER['REMOTE_ADDR'] == $lsm_ip) {
    if($_GET['server_id'] == SERVER_ID) {
        $player = $_GET['player'];
        $user_ip = $_GET['user_ip'];
        if(DEBUG == true) {
            error_log(date('[Y-m-d H:i] ')."[VOTE OK] [player]=$player [ip]=$user_ip".PHP_EOL, 3, LOG_FILE);
        }
        try{
            $bdh = new PDO('mysql:host=frhb62360ds.ikexpress.com;dbname=s1_IsayevDB', 'u1_PlNrhoxlDp', 'DlJor==WI5YEM84TYgzgsOew' );
            $bdh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            echo "Erreur : " . $e->getMessage();
        }

        $requser = $bdh->prepare("SELECT * FROM authme WHERE realname = ?");
        $requser->execute(array($player));
        $userexist = $requser->rowCount();
        if($userexist !== 0) {
            $userName = $player;
            $endPass = '';

            $userNameLower = strtolower($userName);
            $getParams = $bdh->prepare("SELECT * FROM luckperms_players where username = ?");
            $getParams->execute(array($userNameLower));
            $allParamGet = $getParams->fetchAll();
            foreach ($allParamGet as $paramGet9) {
                $getParams = $bdh->prepare("SELECT * FROM Economy where Name = ?");
                $getParams->execute(array($paramGet9['uuid']));
                $allParamGet = $getParams->fetchAll();
                foreach ($allParamGet as $paramGet) {
                    $_SESSION['moneyEconomy'] = $paramGet['Balance'];
                    $moneySend = (int)$paramGet['Balance'] + 300;
                    $addMoney = $bdh->prepare("UPDATE Economy SET Balance = ? WHERE Name = ?");
                    $addMoney->execute(array($moneySend, $paramGet9['uuid']));
                }
            }

            $getTimeLastVote = $bdh->prepare("SELECT * FROM votes where username = ?");
            $getTimeLastVote->execute(array($userName));
            $allLastGet = $getTimeLastVote->fetchAll();
            foreach ($allLastGet as $passGet) {
                $endPass = $passGet['timetamp'];
            }
            $date = new DateTime();
            $ip = $_SERVER['REMOTE_ADDR'];

            if(((int)$endPass + 10800) <  $date->getTimestamp()){
                $reqpseudo = $bdh->prepare("SELECT * FROM votes WHERE username = ?");
                $reqpseudo->execute(array($userName));
                $pseudoexist = $reqpseudo->rowCount();
                if($pseudoexist == 0){
                    $timetamp = $date->getTimestamp();
                    $insertmbr = $bdh->prepare("INSERT INTO votes(username,nbVote, timetamp, ip) VALUES(?,?,?,?)");
                    $insertmbr->execute(array($userName,1, $timetamp, $ip));
                }else {
                    $nbVote = '';
                    $timetamp = $date->getTimestamp();
                    $getTimeNbVote = $bdh->prepare("SELECT * FROM votes where username = ?");
                    $getTimeNbVote->execute(array($userName));
                    $allLastGet = $getTimeNbVote->fetchAll();
                    foreach ($allLastGet as $passGet) {
                        $nbVote = strval($passGet['nbVote']);
                    }
                    $delete = $bdh->prepare("DELETE FROM votes WHERE username = ?");
                    $delete->execute(array($userName));
                    $nbVoteFinal = (int)$nbVote + 1;
                    $insertmbr = $bdh->prepare("INSERT INTO votes(username,nbVote, timetamp, ip) VALUES(?,?,?,?)");
                    $insertmbr->execute(array($userName,$nbVoteFinal, $timetamp, $ip));
                }
            }
        }
    } else {
        if(DEBUG == true) {
            error_log(date('[Y-m-d H:i] ')."[ID INVALIDE] L'ID du serveur ne correspond pas".PHP_EOL, 3, LOG_FILE);
        }
    }
} else {if(DEBUG == true) {
        error_log(date('[Y-m-d H:i] ')."[IP INVALIDE] La requête ne vient pas de Liste-serveurs-minecraft.org".PHP_EOL, 3, LOG_FILE);
    }
}
?>