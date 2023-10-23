<?php

if(session_id() == '') {
    session_start();
}
if (
    isset($_POST['pseudo']) && isset($_POST['motDePasse']) && !empty($_POST['pseudo'])
    && !empty($_POST['motDePasse'])
) {
    require('connexion.php');
    $pseudo = $_POST['pseudo'];
    $motDePasse = $_POST['motDePasse'];
    $sql = "select count(*) as nb from UTILISATEUR where (pseudo = '" . $pseudo . "' and mot_de_passe = '" . $motDePasse . "')
        or (adresse_mail = '" . $pseudo . "' and mot_de_passe = '" . $motDePasse . "')";
    $reponse = $bdd-> query($sql);
    $donnees = $reponse->fetch();
    $nb = $donnees['nb'];
    if ($nb == 1) {
        if ($pseudo == 'admin') {
            $_SESSION['userType'] = 0;
        } else {
            $_SESSION['userType'] = 1;
        }
    }
    else {
        $_SESSION['userType'] = '';
    }
} else {
    echo "unset";
}
