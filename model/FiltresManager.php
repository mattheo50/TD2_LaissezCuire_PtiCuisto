<?php
require_once ("connexion.php");
class FiltresManager extends Connexion{
    public function getTitreRecettes($recherche, $offset) {
        $bdd = $this->dbConnect();
        $req = "select rec_num, titre, image, intitule_cat, resume from RECETTE
                join CATEGORIE using(cat_num)
                where lower(trim(titre)) like lower(trim('%".$recherche."%')) and verifie=1
                limit ".($offset+10);
        $sql = $bdd -> prepare($req);
        $sql -> execute();
        return $sql;
    }

    public function getIngredientRecettes($ing_num, $offset) {
        $bdd = $this->dbConnect();
        $req = "select rec_num, titre, image, intitule_cat, resume from RECETTE
                join CATEGORIE using(cat_num)
                join COMPOSER using (rec_num)
                where ing_num=".$ing_num." and verifie=1
                limit ".($offset+10);
        $sql = $bdd -> prepare($req);
        $sql -> execute();
        return $sql;
    }

    public function getSizeIngredient($ing_num) {
        $bdd = $this->dbConnect();
        $req = "select count(distinct rec_num) from RECETTE
                join COMPOSER using (rec_num)
                where ing_num=".$ing_num." and verifie=1";
        $sql = $bdd -> prepare($req);
        $sql -> execute();
        return $sql->fetch()[0];
    }

    public function getSizeRecherche($recherche) {
        $bdd = $this->dbConnect();
        $req = "select count(*) from RECETTE
                where lower(trim(titre)) like lower(trim('%".$recherche."%')) and verifie=1";
        $sql = $bdd -> prepare($req);
        $sql -> execute();
        return $sql->fetch()[0];
    }

    public function getIngredients() {
        $bdd = $this->dbConnect();
        $req = "select ing_num, intitule_ing from INGREDIENT";
        $sql = $bdd -> prepare($req);
        $sql -> execute();
        return $sql;
    }
}