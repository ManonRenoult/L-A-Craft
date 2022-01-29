<?php
include 'menu.php';
include 'bdd.php';
?>
    <div class="container containerVoter">
        <div class="row voter">
            <div class="offset-3 col-6 testCenter">
                <?php
                function getTimeLastVote($bdh, $nbFunc)
                {
                    if (!empty($_SESSION['username']) && !empty($_SESSION['mdp'])) {
                        if ($nbFunc == 1) {
                            $getParams2 = $bdh->prepare("SELECT * FROM votes where username = ?");
                            $getParams2->execute(array($_SESSION['username']));
                            $allParamGet2 = $getParams2->fetchAll();
                            foreach ($allParamGet2 as $paramGet2) {
                                $date = date_create();
                                $result2 = date_timestamp_set($date, $paramGet2['timetamp']);
                                $date1 = new DateTime("now");
                                $interval = $result2->diff($date1);
                                if ((int)$interval->format('%i') == 0 || (int)$interval->format('%i') == 00) {
                                    return $interval->format('Tu as voté il y a %H heures');
                                } elseif ((int)$interval->format('%H') == 0 || (int)$interval->format('%H') == 00) {
                                    return $interval->format('Tu as voté il y a %i minutes');
                                } else {
                                    return $interval->format('Tu as voté il y a %H heures et %i minutes');
                                }

                            }
                        } elseif ($nbFunc == 2) {
                            $getParams2 = $bdh->prepare("SELECT * FROM votes where username = ?");
                            $getParams2->execute(array($_SESSION['username']));
                            $allParamGet2 = $getParams2->fetchAll();
                            foreach ($allParamGet2 as $paramGet2) {
                                $date = date_create();
                                $result2 = date_timestamp_set($date, $paramGet2['timetamp']);
                                $date1 = new DateTime("now");
                                $interval = $result2->diff($date1);
                                return $interval->format('%H');
                            }
                        }
                    }
                }

                if (!empty($_SESSION['username']) && !empty($_SESSION['mdp'])) {
                    global $bdh;
                    if ((int)getTimeLastVote($bdh, 2) >= 3) {
                        echo '<a href="#" class="width20" onclick="window.open(\'https://www.liste-serveurs-minecraft.org/vote/?idc=202960&nickname=' . $_SESSION['username'] . '\',\'_blank\');"><button type="button"  class="btn btn-primary btnVoterConnecter"><i class="fas fa-thumbs-up"></i>&nbsp;Voter</button></a>';
                    } else {
                        echo '<button type="button" class="btn btn-danger btnVoterWait">Vous devez attendre 3H entre chaque vote !</button>';
                    }
                } else {

                    echo '<a href="#" onclick="document.location.href=\'./connexion?connectOption=1\'"> <button type="button" class="btn btn-warning btnVoter">Veuillez vous connecter pour voter</button></a>';
                }
                ?>
            </div>
        </div>
        <div class="row">
            <p class="rowInfoVote">Pour chaque vote, 300$ vous sont crédité sur L-A.Craft !!<br>Profitez en !</p>
        </div>
        <div class="row scoreTitle">
            <div class="col-3">Classement des TOP Voteurs</div>
            <div class="offset-3 col-6">
                <?php
                echo getTimeLastVote($bdh, 1);
                ?>
            </div>
        </div>
        <div class="row scoreBoard">
            <table class="table table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Pseudo</th>
                    <th scope="col">Nombre de votes</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $getParams2 = $bdh->prepare("SELECT * FROM votes ORDER BY nbVote DESC LIMIT 10");
                $getParams2->execute();
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
                            $rang = ucfirst(substr($paramGet3['permission'], 6));
                            if ($rang == 'Admin') {
                                array_push($allName, $paramGet2['username']);
                                array_push($allVote, $paramGet2['nbVote']);
                                $rangColor = '<div style="color:red" >' . '[ Fondateur ]' . '</div>';
                                array_push($allRang, $rangColor);
                            } else if ($rang == 'Default') {
                                array_push($allName, $paramGet2['username']);
                                array_push($allVote, $paramGet2['nbVote']);
                                $rangColor = '<div style="color:green" >' . '[ Membre ]' . '</div>';
                                array_push($allRang, $rangColor);
                            } else {
                                array_push($allName, $paramGet2['username']);
                                array_push($allVote, $paramGet2['nbVote']);
                                $rangColor = '';
                                if ($rang == 'Vendeur') {
                                    $rangColor = '<div style="color:yellow"> ' . '[ Vendeur ]' . '</div>';
                                } else if ($rang == 'Moderateur') {
                                    $rangColor = '<div style="color:#6f42c1"> ' . '[ Moderateur ]' . '</div>';
                                } else {
                                    $rangColor = '<div style="color:green" >' . '[ Membre ]' . '</div>';
                                }
                                array_push($allRang, $rangColor);
                            }
                        }
                    }
                }
                function whatNum($num)
                {
                    $final = '';
                    if (($num + 1) == 1) {
                        $final = '<i class="fas fa-trophy trophe1"></i>&nbsp;';
                    } elseif (($num + 1) == 2) {
                        $final = '<i class="fas fa-trophy trophe2"></i>&nbsp;';
                    } elseif (($num + 1) == 3) {
                        $final = '<i class="fas fa-trophy trophe3"></i>&nbsp;';
                    }
                    return $final;
                }

                if (!empty($allParamGet2) || $allParamGet2 != '') {
                    for ($i = 0; $i <= (int)count($allName) - 1; $i++) {
                        echo '<tr>
                                        <th scope="row">' . whatNum($i) . ($i + 1) . '</th>
                                        <td><a href="#" class="noStyleLink" onclick="document.location.href=\'./infoPlayer.php?player=' . $allName[$i] . '\'"> ' . $allRang[$i] . '<p class="colorBlack">' . $allName[$i] . '</p></a></td>
                                        <td>' . $allVote[$i] . '</td>
                                   </tr>
                            ';
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
<?php include 'footer.php'; ?>