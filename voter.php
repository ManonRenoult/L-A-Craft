<?php
session_start();
include 'bdd.php';
global $bdh;

function getNbVote($bdh){
    $thisNbVote = -1;
    if (!empty($_SESSION['username']) && !empty($_SESSION['mdp'])) {
        $getParams2 = $bdh->prepare("SELECT * FROM votes where username = ?");
        $getParams2->execute(array($_SESSION['username']));
        $allParamGet2 = $getParams2->fetchAll();
        foreach ($allParamGet2 as $paramGet2) {
            $thisNbVote =  (int)$paramGet2['nbVote'];
        }
    }
    return $thisNbVote;
}

function getTimeLastVote($bdh, $nbFunc) {
    if (!empty($_SESSION['username']) && !empty($_SESSION['mdp'])) {
        if ($nbFunc == 1) {
            $getParams2 = $bdh->prepare("SELECT * FROM votes where username = ?");
            $getParams2->execute(array($_SESSION['username']));
            $allParamGet2 = $getParams2->fetchAll();

            foreach ($allParamGet2 as $paramGet2) {
                $testDate = new DateTime();
                $testDate->setTimestamp($paramGet2['timetamp']);
                return $testDate->format('d/m/Y à H:i');
            }
        } elseif ($nbFunc == 2) {
            $getParams2 = $bdh->prepare("SELECT * FROM votes where username = ?");
            $getParams2->execute(array($_SESSION['username']));
            $allParamGet2 = $getParams2->fetchAll();
            foreach($allParamGet2 as $paramGet2) {
                $date1 = new DateTime("now");
                $testDate = new DateTime();
                $testDate->setTimestamp($paramGet2['timetamp']);
                $diff = $testDate->diff($date1);
                $hours = $diff->h;
                $hours += ($diff->days * 24);
                return $hours;
            }
        }
    }
}

function whatNum($num){
    $final = '';
    if (($num + 1) == 1) {
        $final = '<i class="fa fa-trophy trophe1"></i>&nbsp;';
    } elseif (($num + 1) == 2) {
        $final = '<i class="fa fa-trophy trophe2"></i>&nbsp;';
    } elseif (($num + 1) == 3) {
        $final = '<i class="fa fa-trophy trophe3"></i>&nbsp;';
    }
    return $final;
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
    <title>Vote . L-A Craft</title>
    <link rel="icon" type="image/png" href="https://l-a-craft.fr/images/Litle-logoLADiscordSF.png">
</head>
<body>
<div class="grid">
    <?php include 'menu.php';?>
    <div class="body">
        <div class="body_vote_grid">
            <div class="vote_btn_vote">
                <div class="vote_grid_btn">
                    <div class="vote_allBtn">
                        <?php
                        if (!empty($_SESSION['username']) && !empty($_SESSION['mdp'])) {
                            $nbHours = getTimeLastVote($bdh, 2);
                            $nbVote = getNbVote($bdh);
                            $timeLastVote = (int)$nbHours;
                            if ($timeLastVote >= 3 | $nbVote === -1) {
                                echo '<a href="#" onclick="window.open(\'https://www.liste-serveurs-minecraft.org/vote/?idc=202960&nickname=' . $_SESSION['username'] . '\',\'_blank\');"><button type="button" class="vote_btnVoterConnecter">Voter</button></a>';
                            } else {
                                echo '<button type="button" class="vote_btnVoterWait">Vous devez attendre 3H entre chaque vote !</button>';
                            }
                        } else {
                            echo '<a href="#" onclick="document.location.href=\'./connexion?connectOption=1\'"> <button type="button" role="button" class="vote_btnVoter">Veuillez vous connecter pour voter</button></a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="vote_message">
                <p>Pour chaque vote, 300$ vous sont crédité sur L-A.Craft !!<br>Profitez en !</p>
            </div>
            <div class="vote_table_lastTime">
                <?php
                if (!empty($_SESSION['username']) && !empty($_SESSION['mdp'])) {
                    $voteDate = getTimeLastVote($bdh, 1);
                    $nbVote = getNbVote($bdh);
                    if((int)$nbVote >= 1) {
                        echo 'Dernier vote le ' . $voteDate;
                    }
                }
                ?>
            </div>
            <div class="vote_table_grid">
                <table class="vote_table_body table-fill">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Pseudo</th>
                        <th scope="col">Nombre de votes</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $getParams2 = $bdh->query("SELECT * FROM votes ORDER BY nbVote DESC LIMIT 10");
                    $allParamGet2 = $getParams2->fetchAll();
                    $allName = [];
                    $allVote = [];
                    $allRang = [];

                    foreach ($allParamGet2 as $paramGet2) {
                        $userNameLower = strtolower($paramGet2['username']);
                        $getParams = $bdh->prepare("SELECT * FROM luckperms_players where username = ?");
                        $getParams->execute(array($userNameLower));
                        $allParamGet = $getParams->fetchAll();
                        foreach ($allParamGet as $paramGet) {
                            $getParams3 = $bdh->prepare("SELECT * FROM luckperms_user_permissions where uuid = ?");
                            $getParams3->execute(array($paramGet['uuid']));
                            $allParamGet3 = $getParams3->fetchAll();
                            foreach ($allParamGet3 as $paramGet3) {
                                if(strpos($paramGet3['permission'], 'group.') !== false) {
                                    $rang = ucfirst(substr($paramGet3['permission'], 6));
                                    $allName[] = $paramGet2['username'];
                                    $allVote[] = $paramGet2['nbVote'];
                                    $rangColor = '';
                                    if ($rang === 'Vendeur') {
                                        $rangColor = '<div style="color:yellow !important;"> ' . '[ Vendeur ]' . '</div>';
                                    } else if ($rang === 'Moderateur') {
                                        $rangColor = '<div style="color:#6f42c1 !important;"> ' . '[ Moderateur ]' . '</div>';
                                    } else if($rang === 'Admin'){
                                        $rangColor = '<div style="color:red !important;"> ' . '[ Fondateur ]' . '</div>';
                                    } else {
                                        $rangColor = '<div style="color:green !important;"> ' . '[ Membre ]' . '</div>';
                                    }
                                    $allRang[] = $rangColor;
                                }
                            }
                        }
                    }
                    if ($allParamGet2 != '') {
                        for ($i = 0; $i <= (int)count($allName) - 1; $i++) {
                            echo '<tr>
                                                    <th scope="row">' . ($i + 1) . ' ' . whatNum($i) . '</th>
                                                    <td class="vote_table_username vote_table_cursor_onclick" onclick="document.location.href=\'./infoPlayer.php?player=' . $allName[$i] . '\'"> <div class="vote_table_username">' . $allRang[$i] . $allName[$i] . '</div> </td>
                                                    <td class="vote_table_cursor_onclick" onclick="document.location.href=\'./infoPlayer.php?player=' . $allName[$i] . '\'">' . $allVote[$i] . '</td>
                                                </tr>
                                            ';
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include 'footer.php';?>
</div>
</body>
<script src="js/50cab66c4a.js" crossorigin="anonymous" async defer></script>
<script src="js/jquery.min.js"></script>
</html>
