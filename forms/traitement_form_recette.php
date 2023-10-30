<?php include_once("../templates/navbar.php");
      include_once("config.php");?>
<?php

$categorie = strip_tags($_POST["categorie"]);

$tags = strip_tags($_POST["tags"]);

$titre = strip_tags($_POST["titre"]);

$contenu = strip_tags($_POST["contenu"]);

$resume = strip_tags($_POST["resume"]);

$ingredientPost = strip_tags($_POST["ingredientPost"]);

if(isset($_SESSION['image'])){
    $image = $_POST['image'];
}else{
    $image = "";
};

$max_rec_num = $bdd->query("select max(REC_NUM)+1 from RECETTE");
$rec_num = $max_rec_num->fetch();

if(isset($_SESSION['uti_num'])){
    $uti_num = $_SESSION['uti_num'];
}else{
    $uti_num = 1;
};


$insert_recette = "INSERT INTO RECETTE(REC_NUM, TAG_NUM, CAT_NUM, UTI_NUM, TITRE, CONTENU, RESUME, DATE_CREATION, IMAGE) VALUES (?, ?, ?, ?, ?, ?, ?, sysdate(), ?)";
$statement = $bdd->prepare($insert_recette);
$statement->execute([$rec_num[0], $tags, $categorie, $uti_num, $titre, $contenu, $resume, $image]);
echo "votre recette est en train d'être étudier si elle ne contient rien contraire aux règles d'utilisation elle sera bientôt disonible sur notre site !";

?>