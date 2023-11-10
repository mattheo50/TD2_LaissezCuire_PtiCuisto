<?php

require("model/RecetteManager.php");

class AccueilController{
    public function afficheContenu(){
        $recetteManager = new RecetteManager();
        $recettes = $recetteManager->getDernieresRecettes();
        require("vue/edito.php");
    }
}