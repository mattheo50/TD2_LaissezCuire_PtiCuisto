<?php ob_start() ?>



<form action="" method="post">
    Pseudo ou Email :
    <input type="text" value="<?php echo $conn->updateFormText('pseudo') ?>" name="pseudo">
    Mot de passe :
    <input type="password"  value="<?php echo $conn->updateFormText('motDePasse') ?>" name="motDePasse">
    <input type="submit" value="Se Connecter">
</form>

<?php $content = ob_get_clean();
require("vue/template.php"); ?>