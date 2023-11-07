<?php

session_start();

require_once('Controller/Recette.php');

$recette = new Recette();
$recette->newRecette();