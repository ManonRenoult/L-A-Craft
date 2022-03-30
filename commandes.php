<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <title>Connexion . L-A Craft</title>
</head>
<?php include 'menu.php'; ?>
<body bgcolor="#2a2d2f">
    <div class="contentcheckbox">
        <div>
          <input type="checkbox" id="question1" name="q"  class="questions">
          <div class="plus">+</div>
          <label for="question1" class="question">
            LES COMMANDES DE BASE
        </label>
        <div class="answers">
            <p><li>/help : connaître les commandes de base</li></p>
        </div>
    </div>

    <div>
      <input type="checkbox" id="question2" name="q" class="questions">
      <div class="plus">+</div>
      <label for="question2" class="question">
        GESTION DES POINTS DE TELEPORTATION
    </label>
    <div class="answers">
        <ul></ul>
        <p><li>/spawn : se téléporter au spawn</li>
         <li> /sethome <nomspawn> : définir un point de téléportation dans son terrain (3 par personne)</li>
            <li>/home <nomspawn> : se téléporter sur le point de téléportation dans son terrain</li>
                <li>/tpa <nomjoueur> : envoyer une demande de téléportation vers un joueur</li>
                    <li>/tpaccept : accepter la demande de téléportation d’un joueur</li>
                </p>       
            </div>
        </div>
        <div>
          <input type="checkbox" id="question3" name="q" class="questions">
          <div class="plus">+</div>
          <label for="question3" class="question">
            GESTION DE LA MONNAIE
        </label>
        <div class="answers"> 
            <p><ul>
             <li> /money ou /bal ou / balance : voir son argent</li>
             <li>/pay &lt;pseudo&gt; &lt;montant&gt; : envoyer de l'argent à un autre joueur</li>

         </ul></p>
     </div>
 </div>
 <div>
  <input type="checkbox" id="question4" name="q" class="questions">
  <div class="plus">+</div>
  <label for="question4" class="question">
    LES QUETES
</label>
<div class="answers"> 
    <p>
        <p><ul>
         <li> /quests : Voir les quêtes en cours, les quêtes terminées et les quêtes réalisables.</li>
     </ul></p>
 </p>
</div>
</div>
<div>
  <input type="checkbox" id="question5" name="q" class="questions">
  <div class="plus">+</div>
  <label for="question5" class="question">
    LES JOBS
</label>
<div class="answers"> 
    <p>
        <p><ul>
         <li> /jobs quests : Voir les quêtes disponibles en fonction de vos métiers.</li>
         <li>/jobs shop : Accéder à la boutique pour acheter des items spéciaux</li>
     </ul></p>
 </p>
</div>
</div>
<div>
  <input type="checkbox" id="question5" name="q" class="questions">
  <div class="plus">+</div>
  <label for="question5" class="question">
    VERROUILLER LES COFFRES ET LES PORTES
</label>
<div class="answers"> 
    <p>
    Accroupissez-vous et faites un clic droit sur un bloc verrouillable avec une main vide et vous verrez l'interface graphique pour verrouiller/déverrouiller les blocs. Vous pouvez autoriser vos amis à utiliser vos coffres ou portes en leur donnant l’autorisation grâce à l’interface.</p>
</p>
</div>
</div>
<div>
  <input type="checkbox" id="question5" name="q" class="questions">
  <div class="plus">+</div>
  <label for="question5" class="question">
    CONNAITRE SON TEMPS DE JEU
</label>
<div class="answers"> 
    <p><ul>
     <li> /playtime : connaître le temps passé sur le serveur.</li>
     <li>//playtimetop : connaître le top 10 des temps passés sur le serveur</li>
     <li>/playtime &lt;nomjoueur&gt; : connaître le temps passé sur le serveur d’un joueur</li>
 </ul></p>
</div>
</div>
</div>
</div>

<?php include 'footer.php'; ?>

</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="js/getPlayer.js"></script>
<script src="https://use.fontawesome.com/1654f7ca2e.js"></script>
<script src="https://kit.fontawesome.com/3821d4a8a5.js" crossorigin="anonymous"></script>
</html>