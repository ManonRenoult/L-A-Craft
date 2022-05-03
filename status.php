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
    <title>Status . L-A Craft</title>
</head>
<body>
<div class="grid">
    <?php include 'menu.php';?>
    <div class="body">
        <div class="body_status_grid">
            <iframe class="htframe" src="https://wl.hetrixtools.com/r/c7895d3eba45451207c76f8aa3d785a2/" width="100%" scrolling="no" style="border:none;" sandbox="allow-scripts allow-same-origin allow-popups" onload="iFrameResize([{log:false}],'.htframe')"></iframe>        </div>
    </div>
    <?php include 'footer.php';?>
</div>
</body>
<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/davidjbradshaw/iframe-resizer@master/js/iframeResizer.min.js"></script>
<script src="js/50cab66c4a.js" crossorigin="anonymous" async defer></script>
<script src="js/jquery.min.js"></script>
<script src="js/getPlayer.js"></script>
</html>