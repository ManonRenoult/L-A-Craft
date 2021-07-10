<?php include 'menu.php';
try{
    $bdh = new PDO('mysql:host=frhb62360ds.ikexpress.com;dbname=s1_IsayevDB', 'u1_PlNrhoxlDp', 'DlJor==WI5YEM84TYgzgsOew' );
    $bdh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
}
$player = $_GET['player'];
$rangFinal = '';
$uuidLuckPerm = '';
?>

<div class="container containerProfil zIndex3">
    <div class="row maxHeight">
        <div class="col-lg-3 col-md-12 col-sm-12 divPhotoUser">
            <div class="cardPhotoUser">
                <div class="photoUser">
                    <img class ="photo" src="images/userPhoto.jpg"   >
                </div>
                <div class="userName">
                    <?php
                        if(!empty($_GET['player'])) {
                            echo $player;
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-12 col-sm-12 divInfosUser ">
            <div class="cardInfosUser">
                <div class="row userInfos" >
                    <div class="col-lg-3 col-md-12 col-sm-12 infosTitle">
                        Rang
                    </div>

                    <div class="col-lg-5 col-md-12 col-sm-12 infos">
                        <?php
                            if(!empty($_GET['player'])) {

                                $userNameLower = strtolower($player);
                                $getParams = $bdh->prepare("SELECT * FROM luckperms_players where username = ?");
                                $getParams->execute(array($userNameLower));
                                $allParamGet = $getParams->fetchAll();
                                foreach ($allParamGet as $paramGet) {
                                    $uuidLuckPerm = $paramGet['uuid'];
                                }
                                $getParams = $bdh->prepare("SELECT * FROM luckperms_user_permissions where uuid = ?");
                                $getParams->execute(array($uuidLuckPerm));
                                $allParamGet = $getParams->fetchAll();
                                foreach ($allParamGet as $paramGet) {
                                    $rang = ucfirst(substr($paramGet['permission'], 6));
                                    if($player == 'RetroManiiia' || $player == 'Ryukkk__'){
                                        $rangFinal = 'Fondateur';
                                        echo $rangFinal;
                                    }else {
                                        if ($rang == 'Default'){
                                            $rangFinal = 'Membre';
                                            echo $rangFinal;
                                        }else {
                                            $rangFinal = $rang;
                                            echo $rangFinal;
                                        }
                                    }
                                }
                            }
                        ?>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 fa">
                        <i class="far fa-flag fa-3x"></i>
                    </div>
                </div>
                <div class="row userInfos">
                    <div class="col-lg-3 col-md-12 col-sm-12 infosTitle" >
                        Métier
                    </div>
                    <div class="col-lg-5 col-md-12 col-sm-12 infos">
                        <?php
                            if(!empty($_GET['player'])) {

                                $getParams = $bdh->prepare("SELECT * FROM jobs_users where username = ?");
                                /*mysqli_real_escape_string($bdh,json_encode($_GET['player']));*/
                                $getParams->execute(array($_GET['player']));
                                $allParamGet = $getParams->fetchAll();
                                foreach ($allParamGet as $paramGet) {
                                    $arr = explode(":", $paramGet['quests'], 2);
                                    $jobs = $arr[0];
                                    echo $jobs;
                                }
                            }
                        ?>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 fa">
                        <i class="fas fa-briefcase fa-3x"></i>
                    </div>
                </div>
                <div class="row userInfos">
                    <div class="col-lg-3 col-md-12 col-sm-12 infosTitle" >
                        Inscrit depuis
                    </div>
                    <div class="col-lg-5 col-md-12 col-sm-12 infos">
                        <?php
                        if(!empty($_GET['player'])) {
                            if(true){
                                $getParams = $bdh->prepare("SELECT * FROM authme where realname = ?");
                                $getParams->execute(array($player));
                                $allParamGet = $getParams->fetchAll();
                                foreach ($allParamGet as $paramGet) {
                                    if(!empty($paramGet['timetampWeb'])){
                                        echo $paramGet['timetampWeb'];
                                    }else {
                                        echo 'Pas encore disponible';
                                    }
                                }
                            }else {
                                echo 'Pas encore disponible';
                            }
                        }
                        ?>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 fa">
                        <i class="fas fa-briefcase fa-3x"></i>
                    </div>
                </div>
                <div class="row userInfos">
                    <div class="col-lg-3 col-md-12 col-sm-12 infosTitle" >
                        Nombre de votes
                    </div>
                    <div class="col-lg-5 col-md-12 col-sm-12 infos">
                        <?php


                        $getTimeNbVote = $bdh->prepare("SELECT * FROM votes where username = ?");
                        $getTimeNbVote->execute(array($player));
                        $allLastGet = $getTimeNbVote->fetchAll();
                        foreach ($allLastGet as $passGet) {
                            $nbVote = strval($passGet['nbVote']);
                            echo $nbVote;
                        }
                        ?>

                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 fa">
                        <i class="fas fa-thumbs-up fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php';?>
