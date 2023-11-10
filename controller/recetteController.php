<?php

require_once("model/RecetteManager.php");

class RecetteController{
    public function afficheContenu($rec_num){
        $recetteManager = new RecetteManager();
        $recette = $recetteManager->getUneRecette($rec_num);
        $tags = $recetteManager->getTagsRecette($rec_num);
        require("vue/recette.php");
    }
}