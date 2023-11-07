<?php

require_once("config.php");

Class RecuperationInfoForm {


    function recupListeTags(){
        $tags = $bdd->query("select INTITULE_TAG,TAG_NUM from TAGS");
        return $tags
    }

}