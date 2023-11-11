<?php

require_once("model/RecetteManager.php");

class ListeController{
    public function afficheContenu($offset){
        $recetteManager = new RecetteManager();
        $recettes = $recetteManager->getOffsetRecettes($offset)->fetchAll();
        $count = $recetteManager->getSizeRecettes();
        for ($i = 0; $i < sizeof($recettes); $i++) {
            $recettes[$i]['tags'] = $recetteManager->getTagsRecette($recettes[$i]['rec_num'])->fetchAll();
        }
        $_SESSION['offset'] = $offset;
        require("vue/nosRecettes.php");
    }
}