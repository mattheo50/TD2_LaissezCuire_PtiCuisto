<?php

function liste_deroulante_ingredient_form(){
    echo('<br>');
    echo('<select name="ingredient" id="ingredient_listeDeroul_form_recette">');
    for($i = 0;$i < 10; $i++){
        echo('<option value="Dessert">'.$i.'</option>');
    }
    echo('</select>');
    echo('<button type="button" onclick="liste_deroulante_ingredient_form()">+</button>');
}



?>

