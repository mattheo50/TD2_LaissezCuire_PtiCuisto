<?php ob_start() ?>



<div class="authBox">
    <form class="authForm" action="" method="post">
        <p id="auth_1_1">Nom d'utilisateur :</p>
        <input id="auth_1_2" type="text" value="<?php echo $conn->updateFormText('pseudo') ?>" name="pseudo" required>
        <p>Prénom :</p>
        <input type="text" value="<?php echo $conn->updateFormText('prenom') ?>" name="prenom" required>
        <p>Nom :</p>
        <input type="text" value="<?php echo $conn->updateFormText('nom') ?>" name="nom" required>
        <p>adresse mail :</p>
        <input type="text" value="<?php echo $conn->updateFormText('mail') ?>" name="mail" required>
        <p>Mot de passe :</p>
        <input type="password"  name="motDePasse" required minlength="8">
        <input id="authButton" type="submit" value="S'inscrire">
    </form>
</div>

<?php $content = ob_get_clean();
require("vue/template.php"); ?>