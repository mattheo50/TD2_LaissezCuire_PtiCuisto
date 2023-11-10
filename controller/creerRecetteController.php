<?php
    require("model/RecetteManager.php");
Class CreerRecetteController {

    public function afficheContenu(){
        $recetteManager = new RecetteManager();
        $tags = $recetteManager->getTags();
        require("vue/form_recette.php");
    }

    public function inserer_recette($uti_num,$ingredientPost,$tags,$categorie, $titre, $contenu, $resume, $image){
        $recetteManager = new RecetteManager();
        $recetteManager->ajoutRecette($uti_num,$ingredientPost,$tags,$categorie, $titre, $contenu, $resume, $image);

    }

}