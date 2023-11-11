<?php

require_once("model/FiltresManager.php");
require_once("model/RecetteManager.php");

class FiltresController{
    public function afficheContenuIngredients($ing_num, $offset){
        $filtresManager = new FiltresManager();
        $recetteManager = new RecetteManager();
        
        if ($ing_num != -1) {
            $recettes = $filtresManager->getIngredientRecettes($ing_num, $offset)->fetchAll();
            $count = $filtresManager->getSizeIngredient($ing_num);
        } else {
            $recettes = $recetteManager->getOffsetRecettes($offset)->fetchAll();
            $count = $recetteManager->getSizeRecettes();
        }
        for ($i = 0; $i < sizeof($recettes); $i++) {
            $recettes[$i]['tags'] = $recetteManager->getTagsRecette($recettes[$i]['rec_num'])->fetchAll();
        }
        $_SESSION['offset'] = $offset;
        $ingredients = $filtresManager->getIngredients();
        require("vue/filtresIngredients.php");
    }

    public function afficheContenuCategorie(){
        require("vue/edito.php");
    }
    
    public function afficheContenuTitre($recherche, $offset){
        $filtresManager = new FiltresManager();
        $recetteManager = new RecetteManager();
        
        $recettes = $filtresManager->getTitreRecettes($recherche, $offset)->fetchAll();
        $count = $filtresManager->getSizeRecherche($recherche);
        for ($i = 0; $i < sizeof($recettes); $i++) {
            $recettes[$i]['tags'] = $recetteManager->getTagsRecette($recettes[$i]['rec_num'])->fetchAll();
        }
        $_SESSION['offset'] = $offset;
        require("vue/filtresTitre.php");
    }
}