<?php include 'menu.php';?>

    <div class="container containerVoter">
        <div class="row voter">
            <div class="offset-3 col-6 testCenter">
                <?php
                if(!empty($_SESSION['username']) && !empty($_SESSION['mdp'])){
                    echo '
                                
                                    <a href="#" class="width20" onclick="document.location.href=\'https://www.liste-serveurs-minecraft.org/vote/?idc=202960&nickname='.$_SESSION['username'].'\';"><button type="button"  class="btn btn-primary btnVoterConnecter">Voter</button></a>
                                
                               ';
                }
                else{
                    echo'
                            <a href="#" onclick="document.location.href=\'./connect.php\'"> <button type="button" class="btn btn-warning btnVoter">Veuillez vous connecter pour voter</button></a>
                    ';
                }
                ?>
            </div>
        </div>
        <div class="row scoreTitle">
            Classement des TOP Voteurs
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
                    try{
                        $bdh = new PDO('mysql:host=frhb62360ds.ikexpress.com;dbname=s1_IsayevDB', 'u1_PlNrhoxlDp', 'DlJor==WI5YEM84TYgzgsOew' );
                        $bdh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    }
                    catch(PDOException $e){
                        echo "Erreur : " . $e->getMessage();
                    }

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
                                    array_push($allRang, '[ Fondateur ]');
                                }else if ($rang == 'Default'){
                                    array_push($allName,$paramGet2['username']);
                                    array_push($allVote,$paramGet2['nbVote']);
                                    array_push($allRang, '[ Membre ]');
                                }else {
                                    array_push($allName,$paramGet2['username']);
                                    array_push($allVote,$paramGet2['nbVote']);
                                    array_push($allRang, '[ '.$rang.' ]');
                                }
                            }
                        }
                    }
                    if(!empty($allParamGet2) || $allParamGet2 != ''){
                        for ($i = 0 ; $i <= (int)count($allName)-1 ; $i++ ){
                            echo '
                            <tr>
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