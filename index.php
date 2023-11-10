<?php
session_start();

try{
    require("vue/navbar.php");
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'nosRecettes') {
            require("controller/listeController.php");
            $blog = new ListeController();
            $blog->afficheContenu($_GET['offset']);
        } elseif ($_GET['action'] == 'recette') {
            require("controller/recetteController.php");
            $blog = new RecetteController();
            $blog->afficheContenu($_GET['rec_num']);
        }
        else if($_GET['action'] == 'creerRecette'){
            require("controller/creerRecetteController.php");
            $blog = new CreerRecetteController();
            $blog->afficheContenu();
        }
        else if($_GET['action'] == 'traitementform'){
            require('controller/creerRecetteController.php');
            $categorie = strip_tags($_POST["categorie"]);
            $tags = strip_tags($_POST["tags"]);
            $titre = strip_tags($_POST["titre"]);
            $contenu = strip_tags($_POST["contenu"]);
            $resume = strip_tags($_POST["resume"]);
            $ingredientPost = strip_tags($_POST["ingredientPost"]);
            if(isset($_POST['image'])){
                $image = $_POST['image'];
            }else{
                $image = "https://caer.univ-amu.fr/wp-content/uploads/default-placeholder.png";
            };
            if(isset($_SESSION['uti_num'])){
                $uti_num = $_SESSION['uti_num'];
            }else{
                $uti_num = 1; 
            };
            $creerRecetteController = new CreerRecetteController();
            $creerRecetteController->inserer_recette($uti_num,$ingredientPost, $tags, $categorie,$titre, $contenu, $resume, $image);
            echo '<p>Nous allons éxaminer votre demande</p>';
            echo '<meta http-equiv="refresh" content="5;URL=index.php">';
        }
    }
    else{       
        require_once("controller/accueilController.php");
        $blog = new AccueilController();
        $blog->afficheContenu();
    }
    require("vue/footer.php");
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}