<?php session_start();

require("navbar.php");
require('controller/CreerRecetteController.php');

//recuperation des donnees via POST
$categorie = strip_tags($_POST["categorie"]);

$tags = strip_tags($_POST["tags"]);

$titre = strip_tags($_POST["titre"]);

$contenu = strip_tags($_POST["contenu"]);

$resume = strip_tags($_POST["resume"]);

$ingredientPost = strip_tags($_POST["ingredientPost"]);

//non obligatoire
if(isset($_POST['image'])){
    $image = $_POST['image'];
}else{
    $image = "https://caer.univ-amu.fr/wp-content/uploads/default-placeholder.png";
};


$uti_num = $_SESSION['uti_num'];


$CreerRecetteController = new CreerRecetteController();

$CreerRecetteController->inserer_recette($uti_num,$ingredientPost, $tags, $categorie,$titre, $contenu, $resume, $image);

?>