<?php

//initialise la variable erreur
$erreur = false;

//cré un connexion manager pour utiliser ses méthodes
require("model/ConnexionManager.php");
$conn = new ConnexionManager();

//met la variable errreur à true si certains champs ne sont pas initialisés
if (isset($_POST)) {
    if (!isset($_POST["pseudo"]) || !isset( $_POST["motDePasse"]) || !isset( $_POST["prenom"]) || !isset( $_POST["nom"]) || !isset( $_POST["mail"])) {
        $erreur = true;
    }
} 

//si erreur est à true, affiche la vue
if ($erreur == true) {
    require("vue/inscription.php");
}

else {
    
    if ($conn -> existeUilisateur($_POST['pseudo'])) {
        sleep(3);
        require("vue/inscription.php");
        echo '<p class="error">Cet nom d\'utilisateur ou cette aresse mail est déjà utilisé</p>';
    }
    else {

        $conn -> creerUtilisateur($_POST['pseudo'], $_POST['motDePasse'], $_POST['mail'], $_POST['prenom'], $_POST['nom']);

        echo "Utilisateur crée ! Vous allez être redirigé...";
		echo '<script>document.location="index.php?action=connexion"</script>';  
        
    }
}