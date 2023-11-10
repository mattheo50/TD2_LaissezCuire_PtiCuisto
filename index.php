<?php
session_start();

try{
    require("vue/navbar.php");
    if (isset($_GET['action'])) {
        if ($_GET['action']=='connexion') {
            require("controller/connexionController.php");
            $connexion = new ConnexionController();
            $connexion->afficheContenu();
        }
    }
    else{
        require("controller/accueilController.php");
        $blog = new AccueilController();
        $blog->afficheContenu();
    }
    require("vue/footer.php");
}
catch(Exception $e) {   
    echo 'Erreur : ' . $e->getMessage();
}
