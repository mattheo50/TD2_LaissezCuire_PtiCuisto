<?php
    require("model/RecetteManager.php");
Class CreerRecetteController {

    public function afficheContenu(){
        $recetteManager = new RecetteManager();
        $tags = $recetteManager->getTags();
        require("vue/form_recette.php");
    }

    public function afficheContenuModif($rec_num){
        $recetteManager = new RecetteManager();
        $tags = $recetteManager->getTags();
        $recette = $recetteManager->getUneRecette($rec_num)->fetch();
        require("vue/form_recette.php");
    }

    public function inserer_recette($uti_num,$ingredientPost,$tags,$categorie, $titre, $contenu, $resume, $image){
        $recetteManager = new RecetteManager();
        $recetteManager->ajoutRecette($uti_num,$ingredientPost,$tags,$categorie, $titre, $contenu, $resume, $image);
    }

    public function modifier_recette($rec_num, $uti_num, $ingredientPost, $tags,$categorie, $titre, $contenu, $resume, $image){
        $recetteManager = new RecetteManager();
        $recetteManager->modifRecette($rec_num, $uti_num,$ingredientPost,$tags,$categorie, $titre, $contenu, $resume, $image);
    }

}