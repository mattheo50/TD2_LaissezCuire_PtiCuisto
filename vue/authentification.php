<?php ob_start() ?>

<form action="traitementConnexion.php" method="post">
    Pseudo ou Email :
    <input type="text" name="pseudo">
    Mot de passe :
    <input type="text" name="motDePasse">
    <input type="submit" value="Se Connecter">
</form>

<?php $content = ob_get_clean();
require("vue/template.php"); ?>