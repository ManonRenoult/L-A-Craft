<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" type="text/css">
    <link rel="icon" type="image/png" href="https://membres.l-a-craft-server.fr/images/Litle-logoLADiscordSF.png">
    <title>L-A Craft</title>
</head>
<body>
    <div class="grid">
        <?php include 'menu.php';?>
        <div class="body">
            <div class="body_grid">
                <a class="cardLink image_nous_rejoindre" href="#" onclick="document.location.href='./rejoindre';">
                    <div class="titre_image_grid">
                        <div class="titre_image_index">
                            <p>Nous rejoindre</p>
                        </div>
                    </div>
                </a>
                <a class="cardLink image_nous_evenements" href="#" onclick="document.location.href='./rejoindre';">
                    <div class="titre_image_grid">
                        <div class="titre_image_index">
                            <p>Evenements</p>
                        </div>
                    </div>
                </a>
                 <div class = discordWidget>
                        <iframe src="https://discordapp.com/widget?id=862374067129810964&theme=dark" width="350" height="500" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
                    </div>
                <a class="logo_liste_server" href="https://www.liste-serveurs-minecraft.org">
                <img alt="TOP Serveurs Minecraft" src="https://www.liste-serveurs-minecraft.org/wp-content/themes/DL/framework/img/logo3.png">
                </a>
            </div>
        </div>
        <?php include 'footer.php';?>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="js/getPlayer.js"></script>
</html>