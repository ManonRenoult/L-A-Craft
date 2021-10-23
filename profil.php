<?php include 'menu.php';
if (empty ($_SESSION['username'])) {
    header("Location: ./");
}
?>

<div class="container containerProfil zIndex3">
    <div class="row maxHeight">
        <div class="col-lg-3 col-md-12 col-sm-12 divPhotoUser">
            <div class="cardPhotoUser">
                <div class="photoUser">
                    <img class="photo" src="images/userPhoto.jpg">
                </div>
                <div class="userName">
                    <?php
                    if (!empty ($_SESSION['username'])) {
                        echo $_SESSION['username'];
                    } else {
                        echo 'Connecter vous';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-12 col-sm-12 divInfosUser ">
            <div class="cardInfosUser">
                <div class="row userInfos">
                    <div class="col-lg-3 col-md-12 col-sm-12 infosTitle">
                        Ton rang
                    </div>
                    <div class="col-lg-5 col-md-12 col-sm-12 infos">
                        <?php
                        if (!empty ($_SESSION['rang'])) {
                            echo $_SESSION['rang'];
                        } else {
                            echo 'Connecter vous';
                        }
                        ?>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 fa">
                        <i class="far fa-flag fa-3x"></i>
                    </div>
                </div>
                <div class="row userInfos">
                    <div class="col-lg-3 col-md-12 col-sm-12 infosTitle">
                        Ton métier
                    </div>
                    <div class="col-lg-5 col-md-12 col-sm-12 infos">
                        <?php
                        try {
                            $bdh = new PDO('mysql:host=frhb62360ds.ikexpress.com;dbname=s1_IsayevDB', 'u1_PlNrhoxlDp', 'DlJor==WI5YEM84TYgzgsOew');
                            $bdh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        } catch (PDOException $e) {
                            echo "Erreur : " . $e->getMessage();
                        }
                        if (!empty ($_SESSION['username'])) {
                            $getParams = $bdh->prepare("SELECT * FROM jobs_users where username = ?");
                            /*mysqli_real_escape_string($bdh,json_encode($_GET['player']));*/
                            $getParams->execute(array($_SESSION['username']));
                            $allParamGet = $getParams->fetchAll();
                            foreach ($allParamGet as $paramGet) {
                                $arr = explode(":", $paramGet['quests'], 2);
                                $jobs = $arr[0];
                                echo $jobs;
                            }
                        } else {
                            echo 'Connecter vous';
                        }
                        ?>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 fa">
                        <i class="fas fa-briefcase fa-3x"></i>
                    </div>
                </div>
                <div class="row userInfos">
                    <div class="col-lg-3 col-md-12 col-sm-12 infosTitle">
                        Ton argent
                    </div>
                    <div class="col-lg-5 col-md-12 col-sm-12 infos">
                        <?php
                        if (!empty ($_SESSION['moneyEconomy'])) {
                            echo $_SESSION['moneyEconomy'] . '$';
                        } else {
                            echo 'Connecter vous';
                        }
                        ?>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 fa">
                        <i class="fas fa-dollar-sign fa-3x"></i>
                    </div>
                </div>
                <div class="row userInfos">
                    <div class="col-lg-3 col-md-12 col-sm-12 infosTitle">
                        Nombre de votes
                    </div>
                    <div class="col-lg-5 col-md-12 col-sm-12 infos">
                        <?php
                        try {
                            $bdh = new PDO('mysql:host=frhb62360ds.ikexpress.com;dbname=s1_IsayevDB', 'u1_PlNrhoxlDp', 'DlJor==WI5YEM84TYgzgsOew');
                            $bdh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        } catch (PDOException $e) {
                            echo "Erreur : " . $e->getMessage();
                        }

                        if (!empty ($_SESSION['username']) && !empty ($_SESSION['mdp'])) {
                            $getTimeNbVote = $bdh->prepare("SELECT * FROM votes where username = ?");
                            $getTimeNbVote->execute(array($_SESSION['username']));
                            $allLastGet = $getTimeNbVote->fetchAll();
                            foreach ($allLastGet as $passGet) {
                                $nbVote = strval($passGet['nbVote']);
                                echo $nbVote;
                            }
                        } else {
                            echo 'Connecter vous';
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

<?php include 'footer.php'; ?>
