<?php include 'menu.php';?>
<div class="container-fluid containerAB">

    <div class="row menuTitre">
        <div class="row menuAfftitre">

            <p>Bienvenue sur L.A - server </p>

        </div>
        <div class="row menuAffsoustitre">

            <p>Serveur en 1.16.5</p>

        </div>
        <div class="row menuAffnbjoueurs">


            <div id="nbPLayer"><img src="images/world.png" width="10%">&nbsp;&nbsp;Chargement ...</div>

        </div>
    </div>
</div>
<div class="container containerB">
    <div class="row maxHeight">
        <div class="offset-lg-1 col-lg-5 col-md-12 col-sm-12 boxCard">
            <div class="cardAll">
                <a class="cardLink" href="#"  onclick="document.location.href='./rejoindre.php';">
                    <div class="btn cardAllJoin">
                        <div class="cardTitle">
                            <div class="tucasse">Nous rejoindre</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class=" col-lg-5 col-md-12 col-sm-12 boxCard mediaQueryCard">
            <div class="cardAll">
                <a class="cardLink" href="#"  onclick="document.location.href='./index.php';">
                    <div class="btn cardAllEvent">
                        <div class="cardTitle">
                            <div class="tucasse">Evenements</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="container containerBbis">
    <div class="row titreInfos">
        <p>L-A craft c'est,</p>
    </div>
    <div class="row infosPres">
        <div class="col-lg-4 col-md-12 col-sm-12 ">
            <row><i class="fas fa-user-friends fa-10x"></i><br></row>
            <row>Une communauté mature et impliquée</row>

        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 ">
            <row><i class="fas fa-server fa-10x"></i><br></row>
            <row>Un serveur cracké en version 16.5</row>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 ">
            <row><i class="fas fa-calendar-week fa-10x"></i><br></row>
            <row>Des evenements pour mieux se retrouver</row>
        </div>
    </div>
</div>
<?php include 'footer.php';?>
