<?php

require("model/RecetteManager.php");
require("model/accueilManager.php");

class AccueilController{
    public function afficheContenu(){
        $recetteManager = new RecetteManager();
        $recettes = $recetteManager->getDernieresRecettes();
        require("vue/edito.php");
    }

    public function activerModifEdito(){
        if(isset($_SESSION['admin'])){
                if($_SESSION['admin'] == 'true'){
                    echo ("<button class='editButton' id='modifButton' onclick='versModifier()'>Modifier</button>");
                }
            }
    }

    public function getEdito(){
        $accueilManager = new accueilManager();
        $edito = $accueilManager->getEditoBDD();
        echo $edito;
    }
}