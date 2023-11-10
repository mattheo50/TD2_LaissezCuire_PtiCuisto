<?php

require("model/ConnexionManager.php");

class TestController{


    public function afficheContenu(){
        $conn = new ConnexionManager();
        $con = $conn->getUtilisateur('admin', 'admin');
        if ($_SESSION['admin'] == true) {
            $_SESSION['admin'] = 'true';
        } else {
            $_SESSION['admin'] = 'false';
        }
        echo "session:uti_num : ". $_SESSION['uti_num'] . ' / session:admin : ' . $_SESSION['admin'];
    }
}