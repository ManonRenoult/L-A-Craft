<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
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
            </div>
        </div>
        <?php include 'footer.php';?>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="js/getPlayer.js"></script>
</html>
