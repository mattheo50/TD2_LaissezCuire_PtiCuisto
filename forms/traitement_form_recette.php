<?php include_once("../templates/navbar.php")?>
<?php
echo ("<pre>");
echo(print_r($_POST));
echo ("</pre>");

$categorie = strip_tags($_POST["categorie"]);
echo (print("$categorie"));
$titre = strip_tags($_POST["titre"]);
echo (print("$titre"));
$contenu = strip_tags($_POST["contenu"]);
echo (print("$contenu"));
$resume = strip_tags($_POST["resume"]);
echo (print("$resume"));
$ingredientPost = strip_tags($_POST["ingredientPost"]);
echo (print("$ingredientPost"));
$image = strip_tags($_POST["image"]);
echo (print("$image"));
$rec_num;
$tag_num;
$uti_num = isset($_SESSION['uti_num']);



$insert_recette = "insert into RECETTE(REC_NUM,TAG_NUM,CAT_NUM,UTI_NUM,TITRE,CONTENU,RESUME,DATE_CREATION,IMAGE) values($rec_num,$tag_num,'$categorie',$uti,'$titre','$contenu','$resume',sysdate,'$image')";
echo (print("$insert_recette    "));

?>