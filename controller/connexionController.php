<?php

require("model/ConnexionManager.php");

class ConnexionController{


    public function afficheContenu(){
        $conn = new ConnexionManager();

        require("vue/authentification.php");

        $con = $conn->getUtilisateur('admin', 'admin');
    }
}