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
                if(boolval($_SESSION['admin'])){
                    echo $_SESSION['admin'];
                    echo ("<button onclick='versModifier()'>Modifier</button>");
                }
            }
    }

    public function getEdito(){
        $accueilManager = new accueilManager();
        $edito = $accueilManager->getEditoBDD();
        echo $edito;
    }
}