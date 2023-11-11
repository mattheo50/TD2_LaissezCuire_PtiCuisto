<?php

//initialise la variable erreur
$erreur = false;

//cré un connexion manager pour utiliser ses méthodes
require("model/ConnexionManager.php");
$conn = new ConnexionManager();

//met la variable errreur à true si certains champs ne sont pas initialisés
if (isset($_POST)) {
    if (!isset($_POST["pseudo"]) || !isset( $_POST["motDePasse"])) {
        $erreur = true;
    }
} 

//si erreur est à true, affiche la vue
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