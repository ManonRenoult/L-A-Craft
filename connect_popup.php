<script>
    function openPopup(popup) {
        $(popup).fadeIn(150);
        $("#closePopup").focus();
    }

    function closePopup(popup) {
        $(popup).fadeOut(150);
        $("#openMyPopup").focus();
    }
</script>
<div class="popup" id="myPopup" aria-hidden="true" onClick="if(event.target == this){closePopup('#myPopup');}">
    <form method="post" action="" id="form_connect_popu">
        <div class="wrapper" aria-labelledby="popupTitle" aria-describedby="popupText" aria-modal="true">
            <div class="TitleConnect">
                <h1>Connexion</h1>
            </div>
            <span class="course_divider"><hr></span>
            <div class="pseudoFormConnect">
                <label>Login</label>
                <div class="new-chat-window">
                    <i class="fa fa-user-circle-o"></i>
                    <input type="text" class="new-chat-window-input" placeholder="Pseudo" />
                </div>
            </div>
            <div class="mdpFormConnect">
                <label>Mot de passe</label>
                <div class="new-chat-window">
                    <i class="fa fa-unlock-alt"></i>
                    <input type="password" class="new-chat-window-input" placeholder="*************" />
                </div>
            </div>
            <div class="saveMeConnect">
                <input type="checkbox" id="saveMeConnect_btn" name="saveMeConnect_btn">
                <label for="saveMeConnect_btn">Se souvenir de moi</label>
            </div>
            <div class="btnConnectForm">
                <input type="submit" class="btnConnectForm_btn" value="Se connecter">
            </div>
            <div class="txtConnectForm">
                <p>Le Nom d'utilisateur dois être celui de votre compte Minecraft</p>
                <p>Et le mot de passe dois être le meme qu'a la connexion au serveur L-A-Craft</p>
            </div>
        </div>
    </form>
</div>