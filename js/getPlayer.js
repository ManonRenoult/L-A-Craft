var urlServer = "https://api.minetools.eu/ping/frhb62360ds.ikexpress.com"

$.getJSON(urlServer, function(r) {
    if(r.error){
        //$('#nbPLayer').html('<img src="images/world.png" width="10%">&nbsp;&nbsp;<b>Le serveur est éteint</b>');
        $('#nbPLayer').html('<img src="images/world.png" width="10%">&nbsp;&nbsp;<b>Le serveur est éteint</b>');
        return false;
    }
    var pl = '';
    // Add OP Player
    // if(r.players.sample.length > 0 ){ pl = '<br>OP: '+r.players.sample[0].name;  }
    $('#nbPLayer').html('<img src="images/world.png" width="10%">&nbsp;&nbsp;<b>Joueurs en ligne : </b>&nbsp;'+r.players.online+pl);
});
setInterval(function(){
    $.getJSON(urlServer, function(r) {
        if(r.error){
            $('#nbPLayer').html('<img src="images/world.png" width="10%">&nbsp;&nbsp;<b>Le serveur est éteint</b>');
            return false;
        }
        var pl = '';
        // Add OP Player
        // if(r.players.sample.length > 0 ){ pl = '<br>OP: '+r.players.sample[0].name;  }
        $('#nbPLayer').html('<img src="images/world.png" width="10%">&nbsp;&nbsp;<b>Joueurs en ligne : </b>&nbsp;'+r.players.online+pl);
    });
}, 4000)

setTimeout(function(){
    $('#errorCheck').fadeOut(300, function (){
        if ($('#errorCheck').length > 0) {
            $('#errorCheck').remove();
        }
    })
}, 8000);