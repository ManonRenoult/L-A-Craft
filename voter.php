<?php include 'menu.php';?>

    <div class="container containerVoter">
        <div class="row voter">
            <div class="offset-3 col-6 testCenter">
                <?php
                if(!empty($_SESSION['username']) && !empty($_SESSION['mdp'])){
                    echo '
                                
                               <button type="button" class="btn btn-primary btnVoter">Voter</button>
                               ';
                }
                else{
                    echo'
                    <button type="button" class="btn btn-warning btnVoter">Veuillez vous connecter pour voter</button>
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
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

<?php include 'footer.php';?>