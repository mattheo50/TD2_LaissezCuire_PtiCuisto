<?php

if (
    isset($_POST['pseudo']) && isset($_POST['motDePasse']) && !empty($_POST['pseudo'])
    && !empty($_POST['motDePasse'])
) {
    $pseudo = $_POST['pseudo'];
    $motDePasse = $_POST['motDePasse'];
    $reponse = $bdd->query(
        'select count(*) as nb from utilisateur where (pseudo = ' . $pseudo . ' and mot_de_passe = ' . $motDePasse . ')
        or (adresse_mail = ' . $pseudo . ' and mot_de_passe = ' . $motDePasse . ')'
    );
    require('connexion.php');
    $donnees = $reponse->fetch();
    $nb = $donnees['nb'];
    if ($nb = 1) {
        if(session_id() == '') {
            session_start();
        }
        if ($pseudo == 'admin') {
            $_SESSION['userType'] = 0;
        } else {
            $_SESSION['userType'] = 1;
        }
    }
    else {
        header('Location: formConnexion.php');
    }
} else {
    echo "unset";
}
