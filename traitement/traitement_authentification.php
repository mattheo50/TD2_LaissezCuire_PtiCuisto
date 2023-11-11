<?php

$erreur = false;

if (isset($_POST)) {
    if (!isset($_POST["pseudo"]) || !isset( $_POST["motDePasse"]) || $_POST["pseudo"]=='' || $_POST["motDePasse"]=='') {
        $erreur = true;
    }
} 

if ($erreur == true) {
    require("vue/authentification.php");
}
else {
    require("model/ConnexionManager.php");

    $conn = new ConnexionManager();

    $res = $conn -> getUtilisateur($_POST['pseudo'], $_POST['motDePasse']);

    if ($res == 0) {
        require("vue/authentification.php");
    }
    else {
        echo "oui";
    }
}