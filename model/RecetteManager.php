<?php
require_once ("connexion.php");
class RecetteManager extends Connexion{
    public function getDernieresRecettes() {
        $bdd = $this->dbConnect();
        $req = "select titre, resume, image from RECETTE where verifie = 1 order by date_creation desc limit 3";
        $sql = $bdd -> prepare($req);
        $sql -> execute();
        return $sql;
    }

    public function getOffsetRecettes($offset) {
        $bdd = $this->dbConnect();
        $req = "select rec_num, titre, image, intitule_cat, resume from RECETTE join CATEGORIE using(cat_num) where verifie=1 limit ".($offset+10);
        $sql = $bdd -> prepare($req);
        $sql -> execute();
        return $sql;
    }

    public function getUneRecette($recetteID) {
        $bdd = $this->dbConnect();
        $req = "select * from RECETTE join CATEGORIE using(cat_num) where rec_num=".$recetteID;
        $sql = $bdd -> prepare($req);
        $sql -> execute();
        return $sql;
    }

    public function getSizeRecettes() {
        $bdd = $this->dbConnect();
        $req = "select count(*) from RECETTE where verifie=1";
        $sql = $bdd -> prepare($req);
        $sql -> execute();
        return $sql->fetch()[0];
    }


    public function getIngredientsRecette($recetteID) {
        $bdd = $this->dbConnect();
        $req = "select intitule_ing from COMPOSER join INGREDIENT using(ing_num) where rec_num=".$recetteID;
        $sql = $bdd -> prepare($req);
        $sql -> execute();
        return $sql;
    }
    
    public function getTags(){
        $bdd = $this->dbConnect();
        $req = "select INTITULE_TAG,TAG_NUM from TAGS";
        $sql = $bdd -> prepare($req);
        $sql -> execute();
        return $sql;
    }

    public function getTagsRecette($recetteID) {
        $bdd = $this->dbConnect();
        $req = "select intitule_tag from APPARTENIR join TAGS using(tag_num) where rec_num=".$recetteID;
        $sql = $bdd -> prepare($req);
        $sql -> execute();
        return $sql;
    }
      
    public function ajoutRecette($uti_num,$ingredientPost,$tags,$categorie, $titre, $contenu, $resume, $image){
        $bdd = $this->dbConnect();
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



        // Insertion dans recette    !!!!!!!!!Plus de TAG
        $insert_recette = "INSERT INTO RECETTE(REC_NUM, CAT_NUM, UTI_NUM, TITRE, CONTENU, RESUME, DATE_CREATION,DATE_MODIFICATION, IMAGE) VALUES (?, ?, ?, ?, ?, ?, sysdate(),sysdate() ,?)";
        $statement = $bdd->prepare($insert_recette);
        $statement->execute([$rec_num[0], $categorie, $uti_num, $titre, $contenu, $resume, $image]);

        //Serie d'insertions dans la table composer
        for($i=1;$i < count($ing_num); $i++){
            //j'insere le numéro d'ingrédient à la recette dans la table composer/*
            $insert_composer = "INSERT INTO COMPOSER(REC_NUM, ING_NUM) VALUES (?, ?)";
            $statement = $bdd->prepare($insert_composer);
            $statement->execute([$rec_num[0],$ing_num[$i]]);
        } 
    }
}