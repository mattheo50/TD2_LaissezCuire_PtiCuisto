<?php include_once("../templates/navbar.php"); require("config.php");

//recuperation des donnees via POST
$categorie = strip_tags($_POST["categorie"]);

$tags = strip_tags($_POST["tags"]);

$titre = strip_tags($_POST["titre"]);

$contenu = strip_tags($_POST["contenu"]);

$resume = strip_tags($_POST["resume"]);

$ingredientPost = strip_tags($_POST["ingredientPost"]);

//non obligatoire
if(isset($_SESSION['image'])){
    $image = $_POST['image'];
}else{
    $image = "";
};

//récupération du numéro du prochain numero de recette
$max_rec_num = $bdd->query("select max(REC_NUM)+1 from RECETTE");
$rec_num = $max_rec_num->fetch();

//temporaire à retirer !!!!!!!!
if(isset($_SESSION['uti_num'])){
    $uti_num = $_SESSION['uti_num'];
}else{
    $uti_num = 1;
};

//verification de la validité des ingrédients
$ingredientPost = explode("/",$ingredientPost);
$erreur = false;
for($i=0;$i < count($ingredientPost); $i++){
    // je vais chercher le numéro de l'ingrédient avec le nom entré
    //en vérifiant si l'ingrédient existe
    try{
        $select_ing_num = "SELECT ING_NUM from INGREDIENT WHERE INTITULE_ING = ?";
        $statement = $bdd->prepare($select_ing_num);
        $statement->execute([$ingredientPost[$i]]);
        $ingredient = $statement->fetch();
        $ing_num[];
        array_push($ing_num,$ingredient["ING_NUM"]);
    }catch(PDOException $e){
        $erreur = true;
    }
}

// Si l'ingrédient n'existe pas on ne peut pas l'insérer
if($erreur = true){
    echo "Un problème s'est produit lors de la vérification des ingrédients de la recette";
}else{
    // Insertion dans recette
    $insert_recette = "INSERT INTO RECETTE(REC_NUM, TAG_NUM, CAT_NUM, UTI_NUM, TITRE, CONTENU, RESUME, DATE_CREATION, IMAGE) VALUES (?, ?, ?, ?, ?, ?, ?, sysdate(), ?)";
    $statement = $bdd->prepare($insert_recette);
    $statement->execute([$rec_num[0], $tags, $categorie, $uti_num, $titre, $contenu, $resume, $image]);
    echo "votre recette est en train d'être étudier si elle ne contient rien contraire aux règles d'utilisation elle sera bientôt disonible sur notre site !";

    //Serie d'insertions dans la table composer
    for($i=0;$i < count($ing_num); $i++){
        //j'insere le numéro d'ingrédient à la recette dans la table composer/*
        $insert_composer = "INSERT INTO COMPOSER(REC_NUM, ING_NUM) VALUES (?, ?)";
        $statement = $bdd->prepare($insert_composer);
        $statement->execute([$rec_num[0],$ing_num[$i]]);
    }
}

?>