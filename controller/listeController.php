<?php

require_once("model/RecetteManager.php");

class ListeController{
    public function afficheContenu($offset){
        $recetteManager = new RecetteManager();
        $recettes = $recetteManager->getOffsetRecettes($offset);
        $count = $recetteManager->getSizeRecettes();
        $_SESSION['offset'] = $offset;
        require("vue/nosRecettes.php");
    }
}