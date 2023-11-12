<?php


class ConnexionController{


    public function afficheConnexion(){

        require("traitement/traitement_authentification.php");

    }

    public function afficheInscription(){

        require("traitement/traitement_inscription.php");

    }
}