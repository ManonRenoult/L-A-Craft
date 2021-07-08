<?php include 'menu.php';?>

    <div class="container containerVoter">
        <div class="row voter">
            <div class="offset-3 col-6 testCenter">
                <?php
                try{
                    $bdh = new PDO('mysql:host=frhb62360ds.ikexpress.com;dbname=s1_IsayevDB', 'u1_PlNrhoxlDp', 'DlJor==WI5YEM84TYgzgsOew' );
                    $bdh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
                catch(PDOException $e){
                    echo "Erreur : " . $e->getMessage();
                }
                function getTimeLastVote($bdh, $nbFunc){
                    if(!empty($_SESSION['username']) && !empty($_SESSION['mdp'])){
                        if($nbFunc == 1) {
                            $getParams2 = $bdh->prepare("SELECT * FROM votes where username = ?");
                            $getParams2->execute(array($_SESSION['username']));
                            $allParamGet2 = $getParams2->fetchAll();
                            foreach ($allParamGet2 as $paramGet2) {
                                $date = date_create();
                                $result2 = date_timestamp_set($date, $paramGet2['timetamp']);
                                $date1 = new DateTime("now");
                                $interval = $result2->diff($date1);
                                return $interval->format('Tu a voter il y a %H heures et %i minutes');
                            }
                        }elseif($nbFunc == 2){
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

                if(!empty($_SESSION['username']) && !empty($_SESSION['mdp'])){
                    if((int)getTimeLastVote($bdh,2) >= 3){
                        echo '<a href="#" class="width20" onclick="window.open(\'https://www.liste-serveurs-minecraft.org/vote/?idc=202960&nickname='.$_SESSION['username'].'\',\'_blank\');"><button type="button"  class="btn btn-primary btnVoterConnecter">Voter</button></a>';
                    }else {
                        echo '<button type="button" class="btn btn-danger btnVoterWait">Vous devez attendre 3H entre chaque vote !</button>';
                    }
                } else{

                    echo '<a href="#" onclick="document.location.href=\'./connect.php\'"> <button type="button" class="btn btn-warning btnVoter">Veuillez vous connecter pour voter</button></a>';
                }
                ?>
            </div>
        </div>
        <div class="row scoreTitle">
            <div class="col-3">Classement des TOP Voteurs</div>
            <div class="offset-3 col-6">
                <?php
                    echo getTimeLastVote($bdh,1);
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
                                if ($rang == 'Admin'){
                                    array_push($allName,$paramGet2['username']);
                                    array_push($allVote,$paramGet2['nbVote']);
                                    $rangColor = '<div style="color:red" >'.'[ Fondateur ]'.'</div>';
                                    array_push($allRang, $rangColor);
                                }else if ($rang == 'Default'){
                                    array_push($allName,$paramGet2['username']);
                                    array_push($allVote,$paramGet2['nbVote']);
                                    $rangColor = '<div style="color:green" >'.'[ Membre ]'.'</div>';
                                    array_push($allRang, $rangColor);
                                }else {
                                    array_push($allName,$paramGet2['username']);
                                    array_push($allVote,$paramGet2['nbVote']);
                                    $rangColor = '';
                                    if($rang == 'Vendeur'){
                                        $rangColor = '<div style="color:yellow"> '.'[ Vendeur ]'.'</div>';
                                    }else if($rang == 'Moderateur'){
                                        $rangColor = '<div style="color:#6f42c1"> '.'[ Moderateur ]'.'</div>';
                                    }else{
                                        $rangColor = '<div style="color:green" >'.'[ Membre ]'.'</div>';
                                    }
                                    array_push($allRang, $rangColor);
                                }
                            }
                        }
                    }
                    if(!empty($allParamGet2) || $allParamGet2 != ''){
                        for ($i = 0 ; $i <= (int)count($allName)-1 ; $i++ ){
                            echo '<tr>
                                        <th scope="row">'.($i+1).'</th>
                                        <td>'.$allRang[$i].' '.$allName[$i].'</td>
                                        <td>'.$allVote[$i].'</td>
                                   </tr>
                            ';
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
<?php include 'footer.php';?>