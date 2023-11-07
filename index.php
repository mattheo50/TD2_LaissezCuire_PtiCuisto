<?php
require("controller/accueilController.php");
session_start();

try{
    require("vue/navbar.php");
    if (isset($_GET['action'])) {
    }
    else{
        $blog = new AccueilController();
        $blog->afficheContenu();
    }
    require("vue/footer.php");
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
