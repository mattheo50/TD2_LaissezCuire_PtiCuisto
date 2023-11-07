<?php

require('config.php');

Class Recette {

    public function newRecette(){
        require_once("Vue/form_recette.php");
    }

    public function remplir_tags(){
        $tags = $bdd->query("select INTITULE_TAG,TAG_NUM from TAGS")->fetchAll();
        for($i = 0; $i < count($tags);$i++){
            echo ('<option value="'.$tags[$i]["TAG_NUM"].'">'.$tags[$i]["INTITULE_TAG"].'</option>');
        }
    }


}