<?php
session_start();

try{
    require("vue/navbar.php");
    if (isset($_GET['action'])) {
        if ($_GET['action']=='connexion') {
            require("controller/connexionController.php");
            $connexion = new ConnexionController();
            $connexion->afficheContenu();
        } else if ($_GET['action'] == 'nosRecettes') {
            require("controller/listeController.php");
            $blog = new ListeController();
            $offset = (isset($_GET['offset'])) ? $_GET['offset'] : 0;
            $blog->afficheContenu($offset);
        } elseif ($_GET['action'] == 'recette') {
            require("controller/recetteController.php");
            $blog = new RecetteController();
            $blog->afficheContenu($_GET['rec_num']);
        } elseif (substr($_GET['action'], 0, 7) == 'filtres') {
            require("controller/filtresController.php");
            $offset = (isset($_GET['offset'])) ? $_GET['offset'] : 0;
            $blog = new FiltresController();
            if ($_GET['action'] == 'filtresIngredients') {
                $ing_num = (isset($_POST['ing_num'])) ? $_POST['ing_num'] : -1;
                $blog->afficheContenuIngredients($ing_num, $offset);
            } elseif ($_GET['action'] == 'filtresCategorie') {
                $cat_num = (isset($_POST['cat_num'])) ? $_POST['cat_num'] : -1;
                $blog->afficheContenuCategorie($cat_num, $offset);
            } else {
                $recherche = (isset($_POST['recherche'])) ? $_POST['recherche'] : "";
                $blog->afficheContenuTitre($recherche, $offset);
            }
            
        }
        else if($_GET['action'] == 'creerRecette'){
            require("controller/creerRecetteController.php");
            $blog = new CreerRecetteController();
            $blog->afficheContenu();
        }
        else if($_GET['action'] == 'traitementform'){
            require('controller/creerRecetteController.php');
            $categorie = strip_tags($_POST["categorie"]);
            $tags = strip_tags($_POST["TagPost"]);
            $titre = strip_tags($_POST["titre"]);
            $contenu = strip_tags($_POST["contenu"]);
            $resume = strip_tags($_POST["resume"]);
            $ingredientPost = strip_tags($_POST["ingredientPost"]);
            $image = strip_tags($_POST['image']);
            $uti_num = $_SESSION['uti_num'];
            $creerRecetteController = new CreerRecetteController();
            $creerRecetteController->inserer_recette($uti_num,$ingredientPost, $tags, $categorie,$titre, $contenu, $resume, $image);
            echo '<p>Nous allons éxaminer votre demande, vous allez être redirigé automatiquement vers notre accueil</p>';
            echo '<meta http-equiv="refresh" content="3;URL=index.php">';
        }
        else if($_GET['action'] == 'deconnexion'){
            unset($_SESSION['uti_num']);
            $_SESSION['admin'] = 'false';
            echo 'deconnexion...';
            echo '<script>document.location="index.php"</script>';  
        }
        else if($_GET['action'] == 'validerRecette'){
            require("controller/recetteController.php");
            $validerRecette = new RecetteController();
            $validerRecette->afficheRecetteAVerifier();
        }
        else if($_GET['action'] == 'validerLaRecette'){
            require("controller/recetteController.php");
            $validerRecette = new RecetteController();
            $validerRecette->validerLaRecette($_GET['rec_num']);
            echo '<p>En cours de validation, vous serez redirigé automatiquement vers notre accueil</p>';
            echo '<meta http-equiv="refresh" content="3;URL=index.php">';
       }
        else if($_GET['action'] == 'suppr') {
            require_once("controller/accueilController.php");
            $recetteManager = new RecetteManager();
            $recetteManager->supprimerRecette($_GET['rec_num']);
            echo '<p>En cours de suppression, vous serez redirigé automatiquement vers notre accueil</p>';
            echo '<meta http-equiv="refresh" content="3;URL=index.php">';
        }
        else if($_GET['action'] == 'modifEdito') {
            require_once("vue/modificationEdito.php");
        }
        else if($_GET['action'] == 'EditoModifie') {
            $msg = strip_tags($_POST['contenu']);
            require_once("model/accueilManager.php");
            $manager = new accueilManager();
            $manager->setEdito($msg);
            echo '<script>document.location="index.php"</script>';  
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
