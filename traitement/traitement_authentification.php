<?php

$erreur = false;

require("model/ConnexionManager.php");
$conn = new ConnexionManager();

if (isset($_POST)) {
    if (!isset($_POST["pseudo"]) || !isset( $_POST["motDePasse"]) || $_POST["pseudo"]=='' || $_POST["motDePasse"]=='') {
        $erreur = true;
    }
} 

if ($erreur == true) {
    require("vue/authentification.php");
}
else {

    $res = $conn -> getUtilisateur($_POST['pseudo'], $_POST['motDePasse']);

    if ($res == 0) {
        require("vue/authentification.php");
        echo '<p class="error"> Nom d\'utilisateur ou mot de passe incorrect</p>';
    }
    else {
		echo '<script>document.location="index.php"</script>';  
    }
}