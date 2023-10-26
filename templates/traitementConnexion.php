<?php

if(session_id() == '') {
    session_start();
}
if (
    isset($_POST['pseudo']) && isset($_POST['motDePasse']) && !empty($_POST['pseudo'])
    && !empty($_POST['motDePasse'])
) {
    require_once('connexion.php');
    require_once('modelConnexion.php');
    $pseudo = $_POST['pseudo'];
    $motDePasse = $_POST['motDePasse'];
    $nb = existUtil($pseudo, $motDePasse);
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
