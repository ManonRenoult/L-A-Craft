var urlServer = "https://api.minetools.eu/ping/frhb62360ds.ikexpress.com"

$.getJSON(urlServer, function(r) {
    if(r.error){
        //$('#nbPLayer').html('<img src="images/world.png" width="10%">&nbsp;&nbsp;<b>Le serveur est éteint</b>');
        $('#nbPLayer').html('<i class="fas fa-users"></i>&nbsp;&nbsp;<b>Le serveur est éteint</b>');
        return false;
    }
    var pl = '';
    // Add OP Player
    // if(r.players.sample.length > 0 ){ pl = '<br>OP: '+r.players.sample[0].name;  }
    $('#nbPLayer').html('<i class="fas fa-users"></i>&nbsp;&nbsp;<b>Joueurs en ligne : </b>&nbsp;'+r.players.online+pl);
});
setInterval(function(){
    $.getJSON(urlServer, function(r) {
        if(r.error){
            $('#nbPLayer').html('<i class="fas fa-users"></i>&nbsp;&nbsp;<b>Le serveur est éteint</b>');
            return false;
        }
        var pl = '';
        // Add OP Player
        // if(r.players.sample.length > 0 ){ pl = '<br>OP: '+r.players.sample[0].name;  }
        $('#nbPLayer').html('<i class="fas fa-users"></i>&nbsp;&nbsp;<b>Joueurs en ligne : </b>&nbsp;'+r.players.online+pl);
    });
}, 4000)

setTimeout(function(){
    $('#errorCheck').fadeOut(300, function (){
        if ($('#errorCheck').length > 0) {
            $('#errorCheck').remove();
        }
    })
}, 8000);



//fonction pour le menu en accordeon

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
        this.classList.toggle("active");

        /* Toggle between hiding and showing the active panel */
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}