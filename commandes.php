<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="L-A-Craft est un serveur dans lequel vous pourrez avoir votre métier et gagner votre argent pour vous acheter un terrain, des items, services et bien plus !">
    <meta name="robots" content="index,map,voter,wiki,status">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                    <li>/rtp : se téléporter aléatoirement sur la map job (coût : 500$)</li> 
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
             <li>/pay &lt;joueur&gt; &lt;montant&gt; : envoyer de l'argent à un autre joueur</li>

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
          <input type="checkbox" id="question6" name="q" class="questions">
          <div class="plus">+</div>
          <label for="question6" class="question">
            CLAIM DE CHUNK
        </label>
        <div class="answers"> 
            <p><ul>
                <li>/chunk help : affichier la liste des commandes disponibles</li>
             <li> /chunk claim : claim le chunk sur lequel le joueur se tient (coût 2000$ par chunk). Un joueur peut posséder 50 chunks</li>
             <li>/chunk unclaim : unclaim le chunk sur lequel le joueur est (rapporte 1000$ par chunk)</li>
             <li>/chunk access &lt;joueur&gt; : autorise l'accès au joueur défini à tous vos chunks. Ils ne peuvent pas claim vos chunk ou les retirer, mais ils peuvent interagir avec les blocs à l'intérieur des morceaux</li>
             <li>/chunk give &lt;joueur&gt; : donner le chunk sur lequel le joueur se tient à un joueur</li>
             <li>/chunk info : connaître les infos du chunk sur lequel le joueur se tient</li>
             <li>/chunk name &lt;name&gt; : modifie le nom affiché lorsque quelqu'un entre dans le terrain du joueur</li>
             <li>/chunk altert : active/désactive la récpetion d'alertes losque qu'un joueur entre dans vos chunks</li>
             <li>/chunk show &lt;secondes&gt; : Affiche un contour de bloc autour du bloc actuel (secondes entre 1 et 10). Particules uniquement visibles par vous</li>

         </ul></p>
     </div>
 </div>
<div>
  <input type="checkbox" id="question7" name="q" class="questions">
  <div class="plus">+</div>
  <label for="question7" class="question">
    VERROUILLER LES COFFRES ET LES PORTES
</label>
<div class="answers"> 
    <p>
    Accroupissez-vous et faites un clic droit sur un bloc verrouillable avec une main vide et vous verrez l'interface graphique pour verrouiller/déverrouiller les blocs. Vous pouvez autoriser vos amis à utiliser vos coffres ou portes en leur donnant l’autorisation grâce à l’interface.<br>
/blocprot settings : configurer automatiquement les autorisations des qu'un coffre ou porte est posé</p>
</p>
</div>
</div>
<div>
  <input type="checkbox" id="question8" name="q" class="questions">
  <div class="plus">+</div>
  <label for="question8" class="question">
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
<script src="js/50cab66c4a.js" crossorigin="anonymous" async defer></script>
<script src="js/jquery.min.js"></script>
</html>