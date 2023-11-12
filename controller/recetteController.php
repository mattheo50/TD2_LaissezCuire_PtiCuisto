<?php

require_once("model/RecetteManager.php");

class RecetteController{
    public function afficheContenu($rec_num){
        $recetteManager = new RecetteManager();
        $recette = $recetteManager->getUneRecette($rec_num);
        $tags = $recetteManager->getTagsRecette($rec_num);
        require("vue/recette.php");
    }
    
    public function afficheRecetteAVerifier(){
        $recetteManager = new RecetteManager();
        $recettes = $recetteManager->getRecetteAVerifier()->fetchAll();
        $count = $recetteManager->getNombreRecceteAVerifier();
        for ($i = 0; $i < sizeof($recettes); $i++) {
            $recettes[$i]['tags'] = $recetteManager->getTagsRecette($recettes[$i]['rec_num'])->fetchAll();
        }
        require("vue/adminVerifier.php");
    }

    public function validerLaRecette($rec_num){
        $recetteManager = new RecetteManager();
        $recetteManager->validationRecette($rec_num); 
    }
}