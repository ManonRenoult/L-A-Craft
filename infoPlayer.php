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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="js/getPlayer.js"></script>
</html>
