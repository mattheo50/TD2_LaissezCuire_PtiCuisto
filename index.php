<?php
require("controller/accueilController.php");
require("controller/listeController.php");
require("controller/recetteController.php");
session_start();

try{
    require("vue/navbar.php");
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'nosRecettes') {
            $blog = new ListeController();
            $blog->afficheContenu($_GET['offset']);
        } elseif ($_GET['action'] == 'recette') {
            $blog = new RecetteController();
            $blog->afficheContenu($_GET['rec_num']);
        }
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
