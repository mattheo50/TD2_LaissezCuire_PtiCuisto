<?php

require("config.php");

Class Recette {

    public function newRecette(){
        require_once("Vue/form_recette.php");
    }

    public function remplir_tags(){
        $tags = $bdd->query("select INTITULE_TAG,TAG_NUM from TAGS")->fetchAll();
        for($i = 0; $i < count($tags);$i++){
            echo ('<option value="'.$tags[$i]["TAG_NUM"].'">'.$tags[$i]["INTITULE_TAG"].'</option>');
        }
    }

    public function inserer_recette($uti_num,$ingredientPost,$tags,$categorie, $titre, $contenu, $resume, $image){
        require("config.php");
        //récupération du numéro du prochain numero de recette
        $max_rec_num = $bdd->query("select max(REC_NUM)+1 from RECETTE");
        $rec_num = $max_rec_num->fetch();

        //verification de la validité des ingrédients
        $ingredientPost = explode("/",$ingredientPost);
        $erreur = false;
        $ing_num[] = array();
        for($i=0;$i < count($ingredientPost); $i++){
            // je vais chercher le numéro de l'ingrédient avec le nom entré
            //en vérifiant si l'ingrédient existe
            $ingredient = null;
            $select_ing_num = "SELECT ING_NUM from INGREDIENT WHERE INTITULE_ING = ?";
            $statement = $bdd->prepare($select_ing_num);
            $statement->execute([$ingredientPost[$i]]);
            $ingredient = $statement->fetch();
            if($ingredient == false){
                $max_ing_num = $bdd->query("select max(ing_NUM)+1 from INGREDIENT");
                $ing_num_new = $max_ing_num->fetch();
                $insert_ingredient = "INSERT INTO INGREDIENT(ING_NUM,INTITULE_ING) VALUES(?,?)";
                $statement = $bdd->prepare($insert_ingredient);
                $statement->execute([$ing_num_new[0],$ingredientPost[$i]]);
                $ingredient = $ing_num_new[0];
                array_push($ing_num,$ingredient);
            }else{
                array_push($ing_num,$ingredient['ING_NUM']);
            }   
        }

        // Insertion dans recette
        $insert_recette = "INSERT INTO RECETTE(REC_NUM, TAG_NUM, CAT_NUM, UTI_NUM, TITRE, CONTENU, RESUME, DATE_CREATION, IMAGE) VALUES (?, ?, ?, ?, ?, ?, ?, sysdate(), ?)";
        $statement = $bdd->prepare($insert_recette);
        $statement->execute([$rec_num[0], $tags, $categorie, $uti_num, $titre, $contenu, $resume, $image]);
        echo "votre recette est en train d'être étudier si elle ne contient rien contraire aux règles d'utilisation elle sera bientôt disonible sur notre site !";

        //Serie d'insertions dans la table composer
        for($i=1;$i < count($ing_num); $i++){
            //j'insere le numéro d'ingrédient à la recette dans la table composer/*
            $insert_composer = "INSERT INTO COMPOSER(REC_NUM, ING_NUM) VALUES (?, ?)";
            $statement = $bdd->prepare($insert_composer);
            $statement->execute([$rec_num[0],$ing_num[$i]]);
        } 
    }

}