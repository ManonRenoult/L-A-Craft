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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="js/getPlayer.js"></script>
</html>