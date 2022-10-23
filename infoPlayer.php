<?php
session_start();
include 'bdd.php';
global $bdh;
$player = $_GET['player'];
$rangFinal = '';
$uuidLuckPerm = '';
$jobs = "Aucun";
include 'func_getprofile.php';
$rangColor = '';
    $userNameLower = strtolower($player);
    $getParams = $bdh->prepare("SELECT * FROM luckperms_players where username = ?");
    $getParams->execute(array($userNameLower));
    $allParamGet = $getParams->fetchAll();
    foreach ($allParamGet as $paramGet) {
        $getParams7 = $bdh->prepare("SELECT * FROM jobs_users where username=:username AND player_uuid=:player_uuid AND quests IS NOT NULL");
        $getParams7->BindParam(':username', $player, PDO::PARAM_STR);
        $getParams7->BindParam(':player_uuid', $paramGet['uuid'], PDO::PARAM_STR);
        $getParams7->execute();
        $allParamGet7 = $getParams7->fetchAll();
        foreach ($allParamGet7 as $paramGet7) {
            $jobs = strtok((String)$paramGet7['quests'], ":");
        }
        $getParams3 = $bdh->prepare("SELECT * FROM luckperms_user_permissions where uuid = ?");
        $getParams3->execute(array($paramGet['uuid']));
        $allParamGet3 = $getParams3->fetchAll();
        foreach ($allParamGet3 as $paramGet3) {
            if(strpos($paramGet3['permission'], 'group.') !== false) {
                $rang = ucfirst(substr($paramGet3['permission'], 6));
                if ($rang === 'Vendeur') {
                    $rangColor = '<div class="infoplayer_rank" style="color:yellow !important;"> ' . '[ Vendeur ]' . '</div>';
                } else if ($rang === 'Moderateur') {
                    $rangColor = '<div class="infoplayer_rank" style="color:#6f42c1 !important;"> ' . '[ Moderateur ]' . '</div>';
                } else if($rang === 'Admin'){
                    $rangColor = '<div class="infoplayer_rank" style="color:red !important;"> ' . '[ Admin ]' . '</div>';
                } else if($rang === 'VIP'){
                    $rangColor = '<div class="infoplayer_rank" style="color:red !important;"> ' . '[ VIP ]' . '</div>';
                } else if($rang === 'Fondateur'){
                    $rangColor = '<div class="infoplayer_rank" style="color:red !important;"> ' . '[ Fondateur ]' . '</div>';
                } else if($rang === 'Fondateur2'){
                    $rangColor = '<div class="infoplayer_rank" style="color:deeppink !important;"> ' . '[ Fondatrice ]' . '</div>';
                } else {
                    $rangColor = '<div class="infoplayer_rank" style="color:green !important;"> ' . '[ Membre ]' . '</div>';
                }
            }
        }
    }

function secondsToTimeOld($seconds) {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a jours %h heures, %i minutes et %s secondes');
}

function secondsToTime($inputSeconds) {
    $secondsInAMinute = 60;
    $secondsInAnHour  = 60 * $secondsInAMinute;
    $secondsInADay    = 24 * $secondsInAnHour;
    $days = floor($inputSeconds / $secondsInADay);
    $hourSeconds = $inputSeconds % $secondsInADay;
    $hours = floor($hourSeconds / $secondsInAnHour);
    $minuteSeconds = $hourSeconds % $secondsInAnHour;
    $minutes = floor($minuteSeconds / $secondsInAMinute);
    $remainingSeconds = $minuteSeconds % $secondsInAMinute;
    $seconds = ceil($remainingSeconds);
    $obj = array(
        'd' => (int) $days,
        'h' => (int) $hours,
        'm' => (int) $minutes,
        's' => (int) $seconds,
    );
    return $obj;
}

function seconds2human($ss) {
    $s = $ss%60;
    $m = floor(($ss%3600)/60);
    $h = floor(($ss%86400)/3600);
    $d = floor(($ss%2592000)/86400);
    $M = floor($ss/2592000);

    return " $d jours, $h heures et $m minutes";
}

$json = file_get_contents('User_PlayTime_Data.json');
$json_data = json_decode($json, true);
$newArray[] = $json_data;
$joins = 0;
$time = 0;

for ($i = 0; $i < (int)count($json_data); $i++) {
    if($json_data[$i]["lastName"] === $player) {
        $joins += (int)$json_data[$i]["joins"];
        $time += (int)$json_data[$i]["time"];
    }
}



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="L-A-Craft est un serveur dans lequel vous pourrez avoir votre métier et gagner votre argent pour vous acheter un terrain, des items, services et bien plus !">
    <meta name="robots" content="index,map,voter,wiki,status">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" type="text/css">
    <link rel="icon" type="image/png" href="https://l-a-craft.fr/images/Litle-logoLADiscordSF.png">
    <title>L-A Craft</title>
</head>
<body>
    <div class="grid">
        <?php include 'menu.php';?>
        <div class="body">
            <div class="body_grid">
                 <div class="container_profil">
                    <div class="profil_image_grid">
                        <div class="profil_image_index">

                            <?php
                            $clearRank = '<div class="infoplayer_rank" style="color:green !important;"> ' . '[ Membre ]' . '</div>';
                            if($rangColor != ""){
                                $clearRank = $rangColor;
                            }
                            echo '<div class="showNameInfoPlayer"><p>' . $player . '</p></div>';
                            echo '<div class="showRankInfoPlayer">' . $clearRank . '</div>';
                            echo '<div class="showBodyInfoPlayer"><img draggable="false" src="https://mc-heads.net/body/' .  username_to_uuid($player) . '/100"></div>';

                            ?>
                        </div>
                        <div class="nameCaseInfoPlayer">
                            <div class="metierNameInfoPlayer">
                                <p>Metier = <?php echo $jobs; ?></p>
                            </div>
                            <div class="moneyNameInfoPlayer">
                                <p>Money = </p>
                            </div>
                            <div class="testNameInfoPlayer">
                                <p>Temp de jeu = <?php echo seconds2human($time); ?> </p>
                            </div>
                        </div>
                        <div class="resultCaseInfoPlayer">
                            <div class="metierResultInfoPlayer">
                                <p>Connexion au serveur = <?php echo (String)$joins;?></p>
                            </div>
                            <div class="moneyResultInfoPlayer">
                                <p>Money = </p>
                            </div>
                            <div class="testResultInfoPlayer">
                                <p>Test = </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php';?>
    </div>
</body>
<script src="js/50cab66c4a.js" crossorigin="anonymous" async defer></script>
<script src="js/jquery.min.js"></script>
<script src="js/getPlayer.js"></script>
</html>