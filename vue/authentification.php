<?php ob_start() ?>


<div class="authBox">
    <form class="authForm" action="" method="post">
        <p id="auth_1_1">Pseudo ou Email :</p>
        <input class='grosField' id="auth_1_2" type="text" value="<?php echo $conn->updateFormText('pseudo') ?>" name="pseudo">
        <p>Mot de passe :</p>
        <input class='grosField' type="password"  value="<?php echo $conn->updateFormText('motDePasse') ?>" name="motDePasse">
        <input class='connButton' id="authButton" type="submit" value="Se Connecter">
    </form>
</div>

<div id = "authentificationDiv">
    <p>Pas de compte ?</p>
    <button class='connButton' onclick="document.location='index.php?action=inscription'">Inscrivez vous</button>
</div>

<?php $content = ob_get_clean();
require("vue/template.php"); ?>