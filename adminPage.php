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
    <title>Administration . L-A Craft</title>
</head>
<body>
<div class="grid">
    <?php include 'menu.php';?>
    <div class="body_map">
        <div class="body_map_grid">
            <iframe class="iframe_map" src="https://tickets.l-a-craft-server.fr/dashboard/login.php" scrolling="no" frameborder="0" style="height: 100%; width: 100%"></iframe>
        </div>
        <?php include 'footer.php';?>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="js/getPlayer.js"></script>
</html>