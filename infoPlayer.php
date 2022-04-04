<?php
session_start();
include 'bdd.php';
$player = $_GET['player'];
$rangFinal = '';
$uuidLuckPerm = '';


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
    <link rel="icon" type="image/png" href="https://membres.l-a-craft-server.fr/images/Litle-logoLADiscordSF.png">
    <title>Vote . L-A Craft</title>
</head>
<body>
<div class="grid">
    <?php include 'menu.php';?>
    <div class="body">
        <div class="body_vote_grid">
            <div class="image_profile"></div>
        </div>
    </div>
    <?php include 'footer.php';?>
</div>
</body>
<script src="js/50cab66c4a.js" crossorigin="anonymous" async defer></script>
<script src="js/jquery.min.js"></script>
</html>
