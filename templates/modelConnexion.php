<?php
function existUtil($pseudo, $motDePasse) {
    require_once('connexion.php');
    $req = $bdd-> query("select count(*) as nb from UTILISATEUR where (pseudo = '" . $pseudo . "' and mot_de_passe = '" . $motDePasse . "')
        or (adresse_mail = '" . $pseudo . "' and mot_de_passe = '" . $motDePasse . "')");
    var_dump( $req );
    $donnees = $reponse->fetch();
    if ( $donnees["nb"] == "0") {
        return -1;
    }
    else {
        return 1;
    }
}

?>