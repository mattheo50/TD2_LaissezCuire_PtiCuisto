<?php

include_once("config.php");

//remplit la liste de tag que l'on peut sélectionner

function remplirListeTag(){
    $tags = $bdd->query("select INTITULE_TAG,TAG_NUM from TAGS")->fetchAll();
    for($i = 0; $i < count($tags);$i++){
        echo ('<option value="'.$tags[$i]["TAG_NUM"].'">'.$tags[$i]["INTITULE_TAG"].'</option>');
    }
}

?>

