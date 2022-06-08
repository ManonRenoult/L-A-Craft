<?php
session_start();
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
                 <a class="cardLink image_nous_evenements" href="#" onclick="document.location.href='./reglement';">
                    <div class="titre_image_grid">
                        <div class="titre_image_index">
                            <p>Règlement</p>
                        </div>
                    </div>
                </a>
                <a class="cardLink image_nous_rejoindre" href="#" onclick="document.location.href='./commandes';">
                    <div class="titre_image_grid">
                        <div class="titre_image_index">
                            <p>Les commandes</p>
                        </div>
                    </div>
                </a>
               
                 <div class="discordWidget">
                        <iframe src="https://discordapp.com/widget?id=862374067129810964&theme=dark" width="100%" height="100%" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
                    </div>

                <a class="vote_site" href="https://www.liste-serveurs-minecraft.org"><img alt="Serveurs Minecraft" src="https://www.liste-serveurs-minecraft.org/wp-content/themes/DL/framework/img/logo3.png"></a>
            </div>
        </div>
        <?php include 'footer.php';?>
    </div>
</body>
<script src="js/50cab66c4a.js" crossorigin="anonymous" async defer></script>
<script src="js/jquery.min.js"></script>
<script src="js/getPlayer.js"></script>
</html>